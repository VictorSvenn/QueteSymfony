<?php

namespace App\Form;

use App\Entity\Episode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EpisodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $programs = $options['programs'];
        $choices = [];
        foreach ($programs as $currentProgram){
            $choices[$currentProgram->getTitle()] = [];
            $subSeasons = $currentProgram->getSeasons();
            foreach ($subSeasons as $currentSeason){
                $choices[$currentProgram->getTitle()] []= $currentSeason;
            }
        }
        $builder
            ->add('title')
            ->add('number')
            ->add('synopsis')
            ->add('season', null, ['choices' => $choices, 'choice_label' => 'number'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Episode::class,
            'programs' => []
        ]);
    }
}
