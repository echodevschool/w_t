<?php


namespace App\Form;


use App\Entity\Feedback;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AboutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Ваше имя',
                'required' => false
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Ваше сообщение',
                'required' => true
            ])
            ->add('email', EmailType::class, [
                'label' => 'Ваша почта',
                'required' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Отправить',
            ]);
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Feedback::class
        ]);
    }

}