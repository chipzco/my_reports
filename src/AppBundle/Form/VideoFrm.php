<?php
namespace AppBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


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
			 ->add('language',EntityType::class, array(
					'class'=>'AppBundle:Language',
			 		'choice_label'=>'lname'
				)
			)
			->add('save', SubmitType::class);		
	}
}