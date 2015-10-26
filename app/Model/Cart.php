<?php
App::uses('AppModel', 'Model');
App::uses('CakeSession', 'Model/Datasource');

class Cart extends AppModel {

    public $useTable = false;

    /*
     * add a product to cart
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
        else{
            $allItems[$item_id][$size]=1;

        }
        $this->saveItem($allItems);
    }
    /*
     * get total count of products
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


    /*
     * save data to session
     */
    public function saveItem($data) {
        return CakeSession::write('cart',$data);
    }

    /*
     * read cart data from session
     */
    public function readItem() {
        return CakeSession::read('cart');
    }

}