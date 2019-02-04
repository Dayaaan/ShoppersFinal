<?php

namespace Shop\FrontBundle\Controller;

use Shop\ProductsBundle\Entity\Product;
use Shop\ProductsBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('home/home.html.twig',
            [ "categories" => $categories ]
        );
    }
    /**
    * @Route("/search" , name="search")
    */
    //FORMULAIRE SEARCH
      
    public function searchProductsAction(Request $request) {
        // $_GET parameters
        //$request->query->get('name');
    
        // $_POST parameters
        // $request->request->get('name');
    
        $em = $this->getDoctrine()->getManager();
        //POST
        $search = $request->request->get('search');
        $products = $em->getRepository(Product::class)->sortProductByName($search);
        $categories = $em->getRepository(Category::class)->findAll();
        return $this->render("product/index.html.twig",
            [
                'products' => $products,
                'categories' => $categories
            ]
        );
    }
}
