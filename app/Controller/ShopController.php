<?php
App::uses('CakeEmail', 'Network/Email');

class ShopController extends AppController {
    public $uses = array('Item','Cart','Order','OrderItem');

    /**
     *
     */
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

    /**
     * @param $order
     * @param $to
     * @param $filename
     */
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

    /**
     *
     */
    public function order(){
        $countries = array("Afghanistan", "Aland Islands", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Barbuda", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Trty.", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Caicos Islands", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Futuna Islands", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard", "Herzegovina", "Holy See", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Jan Mayen Islands", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea", "Korea (Democratic)", "Kuwait", "Kyrgyzstan", "Lao", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "McDonald Islands", "Mexico", "Micronesia", "Miquelon", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "Nevis", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestinian Territory, Occupied", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Principe", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Barthelemy", "Saint Helena", "Saint Kitts", "Saint Lucia", "Saint Martin (French part)", "Saint Pierre", "Saint Vincent", "Samoa", "San Marino", "Sao Tome", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia", "South Sandwich Islands", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "The Grenadines", "Timor-Leste", "Tobago", "Togo", "Tokelau", "Tonga", "Trinidad", "Tunisia", "Turkey", "Turkmenistan", "Turks Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "US Minor Outlying Islands", "Uzbekistan", "Vanuatu", "Vatican City State", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (US)", "Wallis", "Western Sahara", "Yemen", "Zambia", "Zimbabwe");
        $captcha = $this->Session->read('captcha_code');
        if ($this->request->is('post')) {
            if(!empty($this->request->data['Order'])) {
                if ( $captcha == $this->request->data['Order']['captcha'] ){
                    $order_details=$this->request->data['Order'];
                    $order_details['order_item_count']=$this->Cart->getCount();
                    $order_details['total']=CakeSession::read('total');
				    $order_details['user_id']=$this->Auth->user('id');
                    $order_details['country']= $countries[$order_details['country']];

                    if(!$this->Order->save($order_details)){
                        $this->Session->setFlash('Something went wrong, please try again!');
                    }
                    $foreign_key=$this->Order->getLastInsertID();
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
                    $email= $order_details['email'];
                    $this->sendBill($order, $email, $filename);
                    //ez töröl mindent, de nekem csak a kosarat kell, a user cuccokat nem (ne jelentkeztessen ki)
                    CakeSession::destroy();
                    $this->view = 'success';
                }
                else{
                    $this->Session->setFlash(__('Captcha code does not match'));
                    $this->redirect(array('action' => 'checkOut'));
                }
            }
        }
    }

    /**
     * @param $filename
     */
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