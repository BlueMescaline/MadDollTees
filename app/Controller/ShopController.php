<?php
App::uses('CakeEmail', 'Network/Email');

class ShopController extends AppController {
    public $uses = array('Item','Cart','Order','OrderItem');


    public function checkOut(){
    $this->view = 'address';
        if (!$this->Auth->loggedIn())  {
            return $this->redirect(array('controller'=>'users','action'=>'login'));

    }

    if ($this->request->is('post')) {
        if(!empty($this->data['OrderItem'])) {
            if(CakeSession::id()==$this->request->data['OrderItem']['Cart']){
                $carts = $this->Cart->readItem();
                if ($carts != null) {
                    $order_item=array();
                    foreach ($carts as $item_id=>$item) {
                        foreach ($item as $size => $count) {
                            $this->Item->id = $item_id;

                        $name=$this->Item->field('name');
                        $price=$this->Item->field('price');

                        $order_item[]=array(
                            'session_id'=>CakeSession::id(),
                            'item_id'=>$item_id,
                            'name'=>$name,
                            'size'=>$size,
                            'price'=>$price,
                            'quantity'=>$count,
                            'subtotal'=>$count*$price
                        );
                        }
                    }
                    $this->OrderItem->saveMany($order_item,array('deep' => true));

                    }
                else  $this->redirect(array('controller'=>'carts','action'=>'view'));
                }
            }
        }

    }

////////////////////////////////////////////////////////
    public function sendBill($order, $to, $filename){
        $Email = new CakeEmail('gmail');
        $Email->emailFormat('html');
        $Email->template('order_details_mail')->viewVars(array('order'=>$order));
        $Email->to($to);
        $Email->subject('Receipt - MadDollTees');
        $Email->replyTo('maddolltees@gmail.com');
        $Email->from ('maddolltees@gmail.com');
        $Email->attachments('../webroot/pdf/'.$filename.'.pdf');
        $Email->send();

        $Email = new CakeEmail('gmail');
        $Email->emailFormat('html');
        $Email->template('order_details_to_admin')->viewVars(array('order'=>$order));
        $Email->to('maddolltees@gmail.com');
        $Email->subject('Receipt - MadDollTees');
        $Email->replyTo('maddolltees@gmail.com');
        $Email->from ('maddolltees@gmail.com');
        $Email->attachments('../webroot/pdf/'.$filename.'.pdf');
        $Email->send();


    }
//////////////////////////////////////////////////////

    public function order(){
        $captcha = $this->Session->read('captcha_code');

        if ($this->request->is('post')) {
            if(!empty($this->request->data['Order'])) {
                if ( $captcha == $this->request->data['Order']['captcha'] ){

                    $order_details=$this->request->data['Order'];
                $order_details['order_item_count']=$this->Cart->getCount();
                $order_details['total']=CakeSession::read('total');
				$order_details['user_id']=$this->Auth->user('id');
                    $this->Order->save($order_details);
                     $foreign_key=$this->Order->getLastInsertID();
                     $email= $order_details['email'];
                $this->OrderItem->updateAll(
                    array('OrderItem.order_id' => $foreign_key),
                    array('OrderItem.session_id' => CakeSession::id())
                );
                $order=$this->OrderItem->find('all', array(
                    'conditions'=>array('OrderItem.session_id' => CakeSession::id())
                ));
                    $this->Session->write('order',$order);

                $filename= date('Y-m-d H.i.s');
                $this->createPdf($filename);

                $this->sendBill($order, $email, $filename);
                CakeSession::destroy();
                $this->view = 'success';
                }else{
                    $this->Session->setFlash(__('Captcha code does not match'));
                    $this->redirect(array('action' => 'checkOut'));

                }
            }

    }
    }
/////////////////////////////////////////////////
    public function createPdf($filename){
        App::import('Vendor', 'dompdf', array('file' => 'dompdf' . DS . 'dompdf_config.inc.php'));

       // $html =file_get_contents('../View/Layouts/asdasd.html');

        ob_start();
        include '../View/Layouts/receipt.ctp';
       // $html=ob_get_contents('../View/Layouts/receipt.html');

        $html = ob_get_clean();

        $this->dompdf = new DOMPDF();
        $papersize = "A4";
        $orientation = 'portrait';
       // $this->dompdf->load_html(file_get_contents('../View/Layouts/asdasd.html'));
        $this->dompdf->load_html(utf8_decode($html), Configure::read('App.encoding'));
        $this->dompdf->set_paper($papersize, $orientation);
        $this->dompdf->render();


        $output = $this->dompdf->output();
        file_put_contents('pdf/'.$filename.'.pdf', $output);

    }



}