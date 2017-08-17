<?php

namespace App\Models;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="phone")
 */
class Phone {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $number;
    
    /**
    * @ORM\ManyToOne(targetEntity="Person", inversedBy="phones")
    * @ORM\JoinColumn(name="person", referencedColumnName="id")
    */
    protected $person;
    
    function __construct(string $number) {
        $this->number = $number;
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNumber() {
        return $this->number;
    }
    
    public function getPerson() {
        return $this->person;
    }
    
    public function setPerson(Person $person) {
        $this->person = $person;
    }
}
