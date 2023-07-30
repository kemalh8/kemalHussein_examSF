<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class EmployeeController extends AbstractController
{
    #[Route('/employee', name: 'app_employee')]
    public function employees(UserRepository $userRepository): Response
    {
        $employees = $userRepository->findAll();

        return $this->render('employee/index.html.twig', [
            'controller_name' => 'EmployeeController',
            'employees' => $employees,
        ]);
    }
}
