<?php
App::uses('AppModel', 'Model');
App::uses('CakeSession', 'Model/Datasource');

class Cart extends AppModel {

    public $useTable = false;

    /**
     * The function add the current intem`s id and size of it, to an assoc. array (the cart)
     * @param $item_id
     * @param $size
     */
    public function addItem($item_id,$size) {
        $allItems = $this->readItem();
        if ($allItems != null) {
            if ((isset($allItems[$item_id])) AND (isset($allItems[$item_id][$size]))){
                    $allItems[$item_id][$size]++;
            }
            else {
                $allItems[$item_id][$size]=1;
            }
        }
        else {
            $allItems[$item_id][$size]=1;
        }
        $this->saveItem($allItems);
    }

    /**Returns the number of items in the cart
     * @return int
     */
    public function getCount() {
        $allItems = $this->readItem();
        if (count($allItems)<1) {
            return 0;
        }
        $count = 0;
        foreach ($allItems as $item) {
            foreach ($item as $countOfSize) {
                $count=$count+$countOfSize;
            }
        }
        return $count;
    }

    /**
     * Gets $data and save(write) it into session
     * @param $data
     * @return bool
     */
    public function saveItem($data) {
        return CakeSession::write('cart',$data);
    }

    /**
     * Read cart data from session variable
     * @return mixed
     */
    public function readItem() {
        return CakeSession::read('cart');
    }
}