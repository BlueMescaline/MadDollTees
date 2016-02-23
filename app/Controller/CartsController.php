<?php
App::uses('AppController', 'Controller');
class CartsController extends AppController {

	public $uses = array('Item','Cart');

/**
 *Add to cart function
 *If the user call this function the item id and the requested size going to be saved to the cart's session variable
 *
*/
    public function add(){
        if ($this->request->is('post')) {
            $item_id=$this->request->data['Cart']['item_id'];
            $item_size=$this->request->data['Cart']['item_size'];
            $this->Cart->addItem($item_id,$item_size);
        }
        $this->redirect(array('controller'=>'items','action'=>'index'));
    }

/**
 *View content of Cart
 * Read the data from Cart's session variable, it is an assoc array
 * vreate another assoc array by id, size and count and set it to view
*/
    public function view() {
		$carts = $this->Cart->readItem();
		$items = array();
		if ($carts != null) {
			foreach ($carts as $item_id => $piece) {
                $items[$item_id]=$piece;
                foreach ($piece as $size => $count) {
                    $items[$item_id][$size] = $this->Item->read(array('id','name','price','image'),$item_id);
                    $items[$item_id][$size]['Item']['count']=$count;
                   // $items[]=$item;
                }
			}
            $this->set('items',$items);
        }
        else $this->Session->setFlash('The cart is empty.');
        $this->set('items',$items);
    }

/**
 * Update cart function
 * read the content of cart and update it with the value set in the update form
 */
    public function update() {
        if ($this->request->is('post')) {
            if (!empty($this->request->data)) {
                $items=$this->Cart->readItem();
                $item_id = $this->request->data['Cart']['item_id'];
                $item_size = $this->request->data['Cart']['item_size'];
                $count = $this->request->data['Cart']['count'];
                function mergeArrays($item_id, $item_size,$count) {
                    $result = array();
                    foreach ( $item_id as $key=>$name ) {
                        $result[$name] = array( $item_size[$key] => $count[$key]);
                    }
                    return $result;
                }
            }
            CakeSession::write('cart', mergeArrays($item_id, $item_size, $count));
            $this->redirect(array('action'=>'view'));
        }
    }

    /**
     * Remove function
     * Removes the selected size of seleted item from the cart
     * @param $size
     * @param $id
     */
    public function remove($size,$id) {
       // $item=$_SESSION['cart'][$id][$size];
       // CakeSession::delete($item);
        unset($_SESSION['cart'][$id][$size]);
        if(empty($_SESSION['cart'][$id])){
            unset($_SESSION['cart'][$id]);
        }
        /*
        $product = $this->Cart->remove($id);
        if(!empty($product)) {
            $this->Session->setFlash($product['Product']['name'] . ' was removed from your shopping cart', 'flash_error');
        }
        */
        return $this->redirect(array('action' => 'view'));
    }
}