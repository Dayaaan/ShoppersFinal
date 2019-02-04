<?php

namespace Shop\ProductsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductOrder
 *
 * @ORM\Table(name="product_order")
 * @ORM\Entity(repositoryClass="Shop\ProductsBundle\Repository\ProductOrderRepository")
 */
class ProductOrder
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    /** 
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(nullable = true)
     */
    private $product;
    /** 
     * @ORM\ManyToOne(targetEntity="OrderDetail")
     */
    private $orderDetail;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return ProductOrder
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return ProductOrder
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set product
     *
     * @param \Shop\ProductsBundle\Entity\Product $product
     *
     * @return ProductOrder
     */
    public function setProduct(\Shop\ProductsBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \Shop\ProductsBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set orderDetail
     *
     * @param \Shop\ProductsBundle\Entity\OrderDetail $orderDetail
     *
     * @return ProductOrder
     */
    public function setOrderDetail(\Shop\ProductsBundle\Entity\OrderDetail $orderDetail = null)
    {
        $this->orderDetail = $orderDetail;

        return $this;
    }

    /**
     * Get orderDetail
     *
     * @return \Shop\ProductsBundle\Entity\OrderDetail
     */
    public function getOrderDetail()
    {
        return $this->orderDetail;
    }
}
