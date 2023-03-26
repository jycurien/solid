<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setTitle("Article " . $i + 1);
            $article->setSlug("article_" . $i + 1);
            $article->setContent("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut imperdiet neque velit, eget consectetur ante dictum ac. Curabitur a sem ut est imperdiet iaculis. Maecenas eleifend velit non felis gravida feugiat. Donec vel est ac mi gravida consequat. Nam vulputate neque vel lectus lacinia efficitur. Aliquam nisi lacus, iaculis ac luctus sed, porttitor vitae risus. Fusce ut posuere odio. Ut consequat non quam et pellentesque. Suspendisse et maximus lectus. Cras tincidunt magna vitae hendrerit ultrices. Pellentesque pretium felis sit amet est luctus, non lacinia felis ultricies. Phasellus tincidunt mauris dignissim, posuere nunc ut, imperdiet neque. Etiam imperdiet euismod tempor. Aenean molestie pharetra lacus vitae ullamcorper. Nunc vel enim condimentum, laoreet risus eu, dapibus leo.\r\n
Pellentesque suscipit sem a vehicula convallis. Donec bibendum vitae nibh nec pharetra. Proin pulvinar, enim non sollicitudin tincidunt, urna quam mattis ante, id dignissim eros orci sed leo. Proin ac porta nulla. Donec aliquam tristique neque, vitae venenatis ligula pretium et. In sit amet pellentesque tellus. Sed pellentesque et metus sit amet lacinia. Phasellus eu mi et dui auctor congue. In sodales lectus vitae aliquam interdum. Sed lacinia elit convallis dui porta pulvinar. Integer ex lectus, vestibulum non erat ut, mollis fringilla sapien. Vivamus condimentum congue elit quis venenatis. Nunc non purus tristique, iaculis ligula eget, tempor purus. Sed hendrerit volutpat dui quis luctus. Nullam semper eros a felis tincidunt, sit amet feugiat risus pellentesque. Aliquam semper tortor urna, ut porta libero dignissim eget.\r\n
Fusce efficitur fringilla malesuada. Aliquam congue sapien diam, sed viverra eros bibendum et. Phasellus molestie sagittis elementum. Duis tincidunt, libero sed suscipit eleifend, enim orci fermentum lacus, quis dapibus felis arcu at massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam tortor sapien, interdum vitae tempus id, pellentesque nec tortor. In commodo porttitor leo laoreet interdum. Praesent lorem ipsum, aliquam feugiat metus sagittis, eleifend ultricies massa. Ut nec dolor et eros suscipit venenatis nec id nulla. Proin porttitor erat sit amet justo tristique, vel ultrices purus venenatis. Suspendisse potenti. Maecenas at sodales est.\r\n
Fusce nec rutrum augue, et aliquam elit. Aliquam ultricies consectetur nibh, vitae ullamcorper purus bibendum at. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum auctor sem nibh, nec aliquet nisi vehicula eget. Fusce varius neque quis enim facilisis, non viverra orci volutpat. Nulla facilisi. In sit amet egestas eros. Nunc neque nisi, laoreet eu cursus eu, egestas vitae elit. Aliquam varius viverra lectus, eget placerat ipsum laoreet vitae. Mauris semper nec enim fringilla fringilla. Nullam volutpat imperdiet lacus, vitae elementum augue volutpat sed. Morbi gravida nulla eget rhoncus mollis. Morbi feugiat dui et augue ullamcorper, rhoncus semper odio sodales. Sed pharetra quam erat, at fringilla ante euismod eu.\r\n
Etiam ex lacus, fermentum sed pellentesque sed, pharetra vitae lectus. Nunc imperdiet porta arcu, eget lacinia lacus scelerisque vitae. Vivamus pharetra, nunc vitae scelerisque dictum, ligula quam lacinia mi, vel ullamcorper turpis ante sit amet quam. Nulla pharetra massa non libero semper, nec ornare dolor dictum. Curabitur maximus libero sit amet laoreet varius. Praesent quis orci metus. Nullam posuere ante ut mi venenatis imperdiet. Curabitur laoreet aliquam velit sit amet vestibulum. Praesent volutpat nulla faucibus ante varius volutpat. Vestibulum eget metus pellentesque enim efficitur semper. Quisque bibendum turpis vitae nisi semper, sit amet finibus augue accumsan. Nunc egestas neque sed augue congue tincidunt. Suspendisse ut egestas eros.");
            $article->setImage("https://picsum.photos/id/" . $i + 10 . "/1000/600");
            $manager->persist($article);
        }

        $manager->flush();
    }
}
