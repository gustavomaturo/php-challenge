<?php

namespace App\Models;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Models\Phone;
use JsonSerializable;
use Validator;

/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person implements JsonSerializable {
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    
     /**
    * @ORM\OneToMany(targetEntity="Phone", mappedBy="person", cascade={"persist", "remove"})
    * @var ArrayCollection|Phone[]
    */
    protected $phones;
    
    function __construct(int $id, string $name) { 
        $this->id = $id;
        $this->name = $name;
        $this->phones = new ArrayCollection;
        $this->validate();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhones() {
        return $this->phones;
    }
    
    public function addPhone(Phone $phone) {
        $phone->setPerson($this);
        $this->phones->add($phone);
    }
    
    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'name'=> $this->name,
            'phones'=> $this->phones->toArray()
        );
    }
    
    public function validate() {
        $validator = Validator::make(
            [
                'id' => $this->id,
                'name' => $this->name,
            ],
            [
                'id' => 'required',
                'name' => 'required'
            ]);
        
        if($validator->fails()) {
             throw new \Exception('Invalid file');
        }
    }
}
