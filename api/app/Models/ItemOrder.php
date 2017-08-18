<?php

namespace App\Models;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Models\ShipOrder;
use JsonSerializable;

/**
 * @ORM\Entity
 * @ORM\Table(name="item_order")
 */
class ItemOrder implements JsonSerializable {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $title;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $note;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $quantity;
    
    /**
     * @ORM\Column(type="decimal", precision=15, scale=2)
     */
    protected $price;
    
    /**
    * @ORM\ManyToOne(targetEntity="ShipOrder", inversedBy="itemOrder")
    * @ORM\JoinColumn(name="ship_order", referencedColumnName="id")
    */
    protected $shipOrder;
    
    public function getId() {
        return $this->id;
    }
    
    public function setId(int $id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }
    
    public function setTitle(string $title) {
        $this->title = $title;
    }
    
    public function getNote() {
        return $this->note;
    }
    
    public function setNote(string $note) {
        $this->note = $note;
    }
    
    public function getQuantity() {
        return $this->quantity;
    }
    
    public function setQuantity(int $quantity) {
        $this->quantity = $quantity;
    }
    
    public function getPrice() {
        return $this->price;
    }
    
    public function setPrice(Float $price) {
        $this->price = $price;
    }
    
    public function getShipOrder() {
        return $this->shipOrder;
    }
    
    public function setShipOrder(ShipOrder $shipOrder) {
        $this->shipOrder = $shipOrder;
    }
    
    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'title'=> $this->title,
            'note' => $this->note,
            'quantity'=> $this->quantity,
            'price' => $this->price
        );
    }
}
