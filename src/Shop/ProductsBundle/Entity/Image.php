<?php

namespace Shop\ProductsBundle\Entity;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="Shop\ProductsBundle\Repository\ImageRepository")
 * @Vich\Uploadable
 */
class Image
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
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageAlt;
    /**
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $imageSize;
    /**
     * @var File
     *
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @Vich\UploadableField(mapping="product_image", fileNameProperty="imageName", size="imageSize")
     */
    private $imageFile;
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="images")
     */
    private $product;
    /**
     * @ORM\Column(name="updated_at", type="datetime")
     *
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * Add image
     *
     * @param \Shop\ProductsBundle\Entity\Image $image
     *
     * @return Image
     */
    public function addImage(\Shop\ProductsBundle\Entity\Image $image)
    {
        $this->images[] = $image;
        return $this;
    }
    /**
     * Remove image
     *
     * @param \Shop\ProductsBundle\Entity\Image $image
     */
    public function removeImage(\Shop\ProductsBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }
    /**
     * If manually uploading a file (i.e. not using Symfony Form) ensure an instance
     * of 'UploadedFile' is injected into this setter to trigger the update. If this
     * bundle's configuration parameter 'inject_on_load' is set to 'true' this setter
     * must be able to accept an instance of 'File' as the bundle will inject one here
     * during Doctrine hydration.
     *
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $imageFile
     */
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;
        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }
    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }
    public function getImageName(): ?string
    {
        return $this->imageName;
    }
    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }
    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }
    /**
     * Set alt
     *
     * @param string $imageAlt
     *
     * @return MainImage
     */
    public function setImageAlt($imageAlt)
    {
        $this->imageAlt = $imageAlt;
        return $this;
    }
    /**
     * Get alt
     *
     * @return string
     */
    public function getImageAlt()
    {
        return $this->imageAlt;
    }
    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Image
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    /**
     * Set product
     *
     * @param \Shop\ProductsBundle\Entity\Product $product
     *
     * @return Image
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
}
