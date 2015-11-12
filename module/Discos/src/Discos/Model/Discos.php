<?php

namespace Discos\Model;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

class Discos implements InputFilterAwareInterface {

    public $id;
    public $cantor;
    public $disco;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->id = ( isset($data['id']) ? $data['id'] : null );
        $this->cantor = ( isset($data['cantor']) ? $data['cantor'] : null );
        $this->disco = ( isset($data['disco']) ? $data['disco'] : null );
    }
    
    public function getArrayCopy()
    {
        return get_object_vars( $this );
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            $factory = new InputFactory();

            $inputFilter->add($factory->createInput(array(
                        'name' => 'id',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'Int'),
                        ),
            )));

            $inputFilter->add($factory->createInput(array(
                        'name' => 'cantor',
                        'required' => true,
                        'filters' => array(
                            array('name' => 'StripTags'),
                            array('name' => 'StringTrim'),
                        ),
                        'validators' => array(
                            array(
                                'name' => 'StringLength',
                                'options' => array(
                                    'encoding' => 'UTF-8',
                                    'min' => 1,
                                    'max' => 100,
                                ),
                            ),
                        ),
            )));

            $inputFilter->add($factory->createInput(
                            array(
                                'name' => 'disco',
                                'required' => true,
                                'filters' => array(
                                    array('name' => 'StripTags'),
                                    array('name' => 'StringTrim'),
                                ),
                                'validators' => array(
                                    array(
                                        'name' => 'StringLength',
                                        'options' => array(
                                            'encoding' => 'UTF-8',
                                            'min' => 1,
                                            'max' => 100,
                                        ),
                                    ),
                                ),
                            )
            ));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        return;
    }

}
