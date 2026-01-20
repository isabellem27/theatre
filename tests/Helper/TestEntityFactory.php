<?php
namespace App\Tests\Helper;

use DateTimeImmutable;
use App\Entity\Categorie;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


final class TestEntityFactory
{

    public static function createUser(
                EntityManagerInterface $en,
                UserPasswordHasherInterface $hasher,
                ?String $email=null,
                String $plainPassword='pwd1234'
            )
    {
        $user= new Utilisateur();
        $user->setEmail($email ??('user'.uniqid().'@test.test'));
        $user->setPassword($hasher->hashPassword($user,$plainPassword));
        $en -> persist($user);
        $en -> flush;
        return $user;
    }

    public static function createCategorie(
        EntityManagerInterface $em,
        ?string $nom = null,
        ?string $slug = null
    ){
        $categorie = new Categorie();
        $categorie->setNom($nom ?? ('Cat '.uniqid()));
        $categorie->setSlug($slug ?? ('cat_'.uniqid()));
        if(method_exists($categorie, 'setCreatedAt')){
            $categorie->setCreatedAt(new DateTimeImmutable());
        }
        $em->persist($categorie);
        $em->flush();
        return $categorie;

    }
}