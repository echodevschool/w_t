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
//    $token = "5137970276:AAFUmw3IFBKcL4TvsMPY1d_4obI54s9oN_E";
//    $chat_id = "637957661";
//
//    foreach ($options as $item => $value) {
//        $txt = "<b>".$item."</b>".$value."%0A";
//    };
//
//    $sendToTelegram = fopen("https://api.telegram.org/bot${$token}sendMessage?chat_id={$chat_id}
//    &parse_mode=html&text={$txt}","r");
//
//if ($sendToTelegram) {
//    echo '<h1>Спасибо за вам отзыв, надеемся он зороший :)</h1>';
//    return true;
//} else {
//    return false;
//}