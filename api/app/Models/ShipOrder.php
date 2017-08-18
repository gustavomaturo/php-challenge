<?php

namespace App\Models;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Models\ItemOrder;
use JsonSerializable;
use Validator;

/**
 * @ORM\Entity
 * @ORM\Table(name="ship_order")
 */
class ShipOrder implements JsonSerializable {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $personOrder;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $address;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $city;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $country;
    
     /**
    * @ORM\OneToMany(targetEntity="ItemOrder", mappedBy="shipOrder", cascade={"persist", "remove"})
    * @var ArrayCollection|ItemOrder[]
    */
    protected $itemOrder;
    
    function __construct() {
        $this->itemOrder = new ArrayCollection;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId(int $id) {
        $this->id = $id;
    }

    public function getPersonOrder() {
        return $this->personOrder;
    }
    
    public function setPersonOrder(int $personOrder) {
        $this->personOrder = $personOrder;
    }

    public function getName() {
        return $this->name;
    }
    
    public function setName(string $name) {
        $this->name = $name;
    }
    
    public function getAddress() {
        return $this->address;
    }
    
    public function setAddress(string $address) {
        $this->address = $address;
    }
    
    public function getCity() {
        return $this->city;
    }
    
    public function setCity(string $city) {
        $this->city = $city;
    }
    
    public function getCountry() {
        return $this->country;
    }
    
    public function setCountry(string $country) {
        $this->country = $country;
    }
    
    public function getItemOrder() {
        return $this->itemOrder;
    }
    
    public function addItemOrder(ItemOrder $itemOrder) {
        $itemOrder->setShipOrder($this);
        $this->itemOrder->add($itemOrder);
    }
    
    public function addItemOrderXML($item) {
        
        if(!is_array($item)) {
            $item = array($item);
        }
        
        foreach($item as $obj) {
            $itemOrder = new ItemOrder();
            $itemOrder->setTitle($obj->title);
            $itemOrder->setNote($obj->note);
            $itemOrder->setQuantity((int)$obj->quantity);
            $itemOrder->setPrice((float)$obj->price);

            $this->addItemOrder($itemOrder);
        }
    }
    
    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'personOrder'=> $this->name,
            'name' => $this->name,
            'address'=> $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'itemOrder' => $this->itemOrder->toArray()
        );
    }
    
    public function validate($shipOrder) {
        $validator = Validator::make(
            [
                'orderid' => (int)$shipOrder->orderid,
                'orderperson' => (int)$shipOrder->orderperson,
                'name' => $shipOrder->shipto->name,
                'address' => $shipOrder->shipto->address,
                'city' => $shipOrder->shipto->city,
                'country' => $shipOrder->shipto->country
            ],
            [
                'orderid' => 'required',
                'orderperson' => 'required',
                'name' => 'required',
                'address' => 'required',
                'city' => 'required',
                'country' => 'required'
            ]);
        
        if($validator->fails()) {
             throw new \Exception('Invalid file');
        }
    }
}
