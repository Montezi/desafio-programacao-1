<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class VendaModel extends CI_Model{

   private $id_venda;
   private $purchaser_name;
   private $item_description;
   private $item_price;
   private $purchase_count;
   private $merchant_adress;
   private $merchant_name;

    function __construct()
    {

        parent::__construct();
    }

    
    public function setIdVenda($id_venda)
    {
        $this->id_venda = $id_venda;
    }

    
    public function getIdVenda()
    {
        return $this->id_venda;
    }

   
    public function setPurchaserName($purchaser_name)
    {
        $this->purchaser_name = $purchaser_name;
    }

    public function getPurchaserName()
    {
        return $this->purchaser_name;
    }

    public function setItemDescription($item_description)
    {
        $this->item_description = $item_description;
    }

    
    public function getItemDescription()
    {
        return $this->item_description;
    }

   
    public function setItemPrice($item_price)
    {
        $this->item_price = $item_price;
    }

    
    public function getItemPrice()
    {
        return $this->item_price;
    }

    
    public function setPurchaseCount($purchase_count)
    {
        $this->purchase_count = $purchase_count;
    }

    
    public function getPurchaseCount()
    {
        return $this->purchase_count;
    }

    
    public function setMerchantAdress($merchant_adress)
    {
        $this->merchant_adress = $merchant_adress;
    }

    
    public function getMerchantAdress()
    {
        return $this->merchant_adress;
    }

    
    public function setMerchantName($merchant_name)
    {
        $this->merchant_name = $merchant_name;
    }

   
    public function getMerchantName()
    {
        return $this->merchant_name;
    }

    

    public function salvar()
    {


        $dados = array(

            'purchaser_name' => $this->getPurchaserName(),
            'item_description' => $this->getItemDescription(),
            'item_price' => $this->getItemPrice(),
            'purchase_count' => $this->getPurchaseCount(),
            'merchant_adress' => $this->getMerchantAdress(),
            'merchant_name' => $this->getMerchantName()            
        );

        $this->db->insert('venda', $dados);

    }



}