<?php

namespace Shop\ProductsBundle\Form;

use Shop\ProductsBundle\Form\ImageType;
use Symfony\Component\Form\AbstractType;
use Shop\ProductsBundle\Form\MainImageType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProductType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
                ->add('description')
                ->add('price')
                ->add('quantity')
                ->add('categories',null)
                ->add('mainImage', MainImageType::class)
                ->add('images', CollectionType::class,
                    [
                        'entry_type' => ImageType::class,
                        'entry_options' => array('label' => false),
                        'allow_add' => true
                    ])
                ->add("Submit", SubmitType::class)
        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Shop\ProductsBundle\Entity\Product'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'shop_productsbundle_product';
    }


}
