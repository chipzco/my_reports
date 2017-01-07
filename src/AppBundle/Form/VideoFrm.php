<?php
namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class VideoFrm extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
			->add('filename')
			->add('subjectname')
			->add('patientact', ChoiceType::class, array(
    			'choices'  => array(
        				'Choose One' => 0,
        				'Patient' => 1,
    					'Actor'=>2,
    					'Unknown' => 3
    			  	  )
			   )
			)
			 ->add('videoid')
			 ->add('Language',EntityType::class, array(
					'class'=>'AppBundle:Language',
			 		'choice_label'=>'lname'	
			 		
				)
			)
			
			->add('transcripts',CollectionType::class, array(
					'entry_type'=>EntityType::class,	
					'entry_options'=>array(
						'class'=>'AppBundle:Language',
						'choice_label'=>'lname'
					),
					'allow_add'=>true,
					'allow_delete'=>true,
					'prototype'=>false
				) 
			)
			
			
			->add('save', SubmitType::class);		
	}
}