<?php

namespace App\Models;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use App\Models\Phone;

/**
 * @ORM\Entity
 * @ORM\Table(name="person")
 */
class Person {
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
    * @ORM\OneToMany(targetEntity="Phone", mappedBy="person", cascade={"persist"})
    * @var ArrayCollection|Phone[]
    */
    protected $phones;
    
    function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
        $this->phones = new ArrayCollection;
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
}
