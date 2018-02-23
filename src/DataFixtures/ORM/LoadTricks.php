<?php

namespace App\DataFixtures\ORM;


use App\Entity\Tricks;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadTricks extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $mute = new Tricks();
        $mute->setTrickGroup($this->getReference('group_grab'));
        $mute->setTitle('Mute');
        $mute->setContent('Il faut d\'abord faire un saut, un simple ollie par exemple. Bien plier les jambes une fois en l’air pour se regrouper, et aller chercher la planche avec la main. Attention il ne faut pas que le buste se casse en deux pour aller chercher la board : ce sont bien les genoux qui remontent pour amener la board vers la main. Pour effectuer un Mute : la main avant grabbe la carre frontside entre les pieds');
        $manager->persist($mute);
        $this->addReference('Mute', $mute);

        $melon = new Tricks();
        $melon->setTrickGroup($this->getReference('group_grab'));
        $melon->setTitle('Melon');
        $melon->setContent('Il faut d\'abord faire un saut, un simple ollie par exemple. Bien plier les jambes une fois en l’air pour se regrouper, et aller chercher la planche avec la main. Attention il ne faut pas que le buste se casse en deux pour aller chercher la board : ce sont bien les genoux qui remontent pour amener la board vers la main. Pour effectuer un Melon : la main avant grabbe la carre bakside entre les talons. En désaxant le corps et la board cela peut faire un Method ou un Backside Air.');
        $manager->persist($melon);

        $indy = new Tricks();
        $indy->setTrickGroup($this->getReference('group_grab'));
        $indy->setTitle('Indy');
        $indy->setContent('Il faut d\'abord faire un saut, un simple ollie par exemple. Bien plier les jambes une fois en l’air pour se regrouper, et aller chercher la planche avec la main. Attention il ne faut pas que le buste se casse en deux pour aller chercher la board : ce sont bien les genoux qui remontent pour amener la board vers la main. Pour effectuer un Indy : la main arrière vient graber la carre frontside entre les pieds. Sur un saut droit c’est un Indy Grab, sur un hip ou un quarter en front c’est un frontside indy ou frontside grab alors que sur un saut en back (3.6 back par exemple) ça sera un backside Indy..');
        $manager->persist($indy);

        $f720 = new Tricks();
        $f720->setTrickGroup($this->getReference('group_rotation'));
        $f720->setTitle('Frontside 720');
        $f720->setContent('
Le Frontside 7, comment ça marche :

1 - La phase d’approche consiste à arriver bien fléchi sur le kicker, la planche bien à plat, les épaules dans l’axe de la board, le regard fixé sur le bout du kicker.

2 - L\'impulsion se fait à 2 pieds au bout du kicker. Ne pas pousser trop fort aux premiers essais au risque d’être déséquilibré. Donc impulsion à 2 pieds, en lançant la rotation avec les épaules comme un 5.4 front (voir le tuto) mais il faut les lancer plus vite et donc plus fort, à affiner selon la taille du saut. Pour un Frontside 720, on peut avoir une impulsion bien à plat,  en appui léger sur les talons ou encore en appuie pointe de pieds, suivant le style qu\'on veut donner à son tricks et surtout suivant comme on se sent le plus à l’aise de faire. Mais surtout il ne faut déraper le moins possible sur le kicker pour ne pas perdre d’élan, en particulier sur une table de park.

3 - Pour que la rotation se fasse bien à plat il faut lancer le mouvement avec  les épaules à l’horizontale et la tête qui va vers l’épaule avant. Pour désaxer, c’est la tête qui va chercher à twister le mouvement et les épaules ne seront plus à l’horizontale.

4 - Dès que l’on est en l’air il faut se regrouper et grabber. Pour commencer je conseille le Melon (voir tuto sur les grabs). Une fois que l’on maitrise bien le mouvement on peut changer de grab. Dans tous les cas, la main de libre va chercher à emmener la rotation et aider à contrôler la vitesse à laquelle on tourne.

5 - Il faut aller chercher la réception du regard par dessus l’épaule avant : on l’aperçoit après 3/4 de tour puis très bien après le premier 360. À ce moment là, ne pas la fixer et continuer de regarder vers l\'épaule pour continuer à emmener la rotation. Enrouler bien le mouvement pour continuer à tourner toujours en allant chercher du regard et en s’aidant de la main qui ne grave  pas. À partir de maintenant tout va ce passer comme pour la fin d’un 3.6 front.

6 - Quand on voit la réception arriver entre les pieds, il faut amener la board dans l’axe de la réception et détendre les jambes pour chercher à atterrir la planche la plus à plat possible

7 - On amortit bien en regardant ses pieds pour être sûr que la rotation s’arrête. Le défaut le plus commun est de regarder devant au moment ou on atterrit. Du coup, sans en avoir conscience, les  épaules ont fait quelques degrés de plus car elles continuent à tourner emportées par le mouvement, ce qui déséquilibre la réception, et souvent on tombe sur le cul. Donc réception en appuie sur les deux pieds, en regardant ses pieds, on ne relève la tête qu’une fois que l’on a bien amorti.

Au boulot !');
        $manager->persist($f720);


        $b180 = new Tricks();
        $b180->setTrickGroup($this->getReference('group_rotation'));
        $b180->setTitle('Backside 180');
        $b180->setContent('Le Backside 180 peut s’expliquer en plusieurs phases :
1 - La phase d’approche consiste à avoir sa planche la plus à plat possible ou légèrement sur la carre frontside ; le regard est pointé vers le spot (l’endroit où on veut décoller). Les jambes sont fléchies, prêtes à donner une impulsion.

2 - L’impulsion : on a le choix entre un ollie façon skate (comme on peut le voir dans notre tuto sur le Ollie) et une impulsion franche à deux pieds. L’impulsion à deux pieds conviendra mieux sur un kicker de park alors qu’un ollie plus skate et un peu sur la carre est plus évident en bord de piste. Donc on envoie une impulsion  en enclenchant très doucement les épaules de 30°.

3 - Engager la rotation à l’aveugle, de dos… pas de panique, l’astuce est de regarder votre pied arrière pour voir défiler le sol en dessous et permettre au corps de faire un 180° progressif. Attendez de voir la réception pour ajuster la board  tout en gardant les épaules dans l’axe de la planche ou légèrement en retard pour bien arrêter la rotation.

4 - En réception : bien amortir sur les jambes, continuer de regarder entre les pieds pour garder l’équilibre. Ce n’est qu’une fois que l\'on a bien amorti qu\'on pourra relever la tête et regarder ou l\'on va…
Avant d’essayer un 180 back, le mieux est d\'essayer de bien rider en switch pour que ce ne soit pas trop la panique à l’atterrissage et de bien repérer le terrain et les autres rideurs pour ne pas provoquer de collisions. 
À vous de jouer ! Comme d’habitude, allez y progressivement, amusez vous  et prenez beaucoup de plaisir pour faire des backside 180, qui est à notre avis un de plus beaux tricks du snowboard…');
        $manager->persist($b180);


        $valeflip = new Tricks();
        $valeflip->setTrickGroup($this->getReference('group_flip'));
        $valeflip->setTitle('Valeflip');
        $valeflip->setContent('Pour expliquer un peu ce trick, il faudrait déjà lui donner un nom ! C’est un mélange entre un fs 5 underflip et un rodéo 5. 
En tout cas, c’est clairement un trick inspiré du pipe que j’ai adapté à ce petit bout de quarter fait maison. Je vais essayer de vous donner les différentes étapes mais comme pour beaucoup de tricks, je pense que le plus important c’est d’avoir la rotation en tête et après c’est beaucoup de feeling. En premier il faut déjà prendre le bon speed, bien adapté au spot que vous ridez. Ensuite, pour utiliser tout le potentiel de votre spot, il faut bien attendre la toute fin du kick/courbe pour lancer le trick. On arrive board à plat, on laisse sortir le nose et, à ce moment-là, on pope (photo 1). 
Si vous déclenchez trop tôt, vous allez perdre en hauteur et surtout risquer de replaquer sur le coping ! Donc on se laisse bien sortir et une fois en l’air on envoie l’épaule gauche et la tête pour commencer la rotation (photo 2). 
Ensuite on vient rapidement grabber avec l’autre main (photo 3) et on reste en boule tout le long pour que la rotation soit fluide (photo 4).
Et enfin, comme pour la plupart des tricks, on vient chercher la réception avec le regard afin d’anticiper (photos 5-7). Si vous êtes dans le bon timing tout se passera bien.
Le plus simple pour apprendre reste de se lancer, donc je vous conseille d’essayer, vous allez voir c’est pas si dur !');
        $manager->persist($valeflip);


        $tailslide = new Tricks();
        $tailslide->setTrickGroup($this->getReference('group_slide'));
        $tailslide->setTitle('Cab 2.7 in Bs Tailslide 2.7 out');
        $tailslide->setContent('Arriver en fakie tout en regardant bien le kicker, puis à l’approche du module, popper et effectuer un trois quarts de tour (photo 1).
Le fait d’amener le haut du corps face au rail vous permettra de tourner plus facilement vos jambes. Une fois posé sur le tail de votre planche, placez votre poids sur la jambe droite (photo 4), stabilisez-vous en bloquant vos épaules afin de ne pas faire de surrotation sur le rail (photo 6). 
Anticipez la sortie en venant regarder au-dessus de votre épaule (photo 9), et finissez par une légère rotation du haut du corps afin que le bas suive et effectue un 2.7 en sortie (photo 10 à 12). 
Si tout marche bien, surtout ne regardez pas derrière vous, mais dirigez vos yeux vers un point au loin, et gardez une attitude de sobre nonchalance. Bingo.');
        $manager->persist($tailslide);


        $ollie = new Tricks();
        $ollie->setTrickGroup($this->getReference('group_ollie'));
        $ollie->setTitle('Ollie');
        $ollie->setContent('Le Ollie peut se décomposer en plusieurs phases :

1. La phase d’approche consiste à avoir sa planche la plus à plat possible ou légèrement sur la carre; le regard pointé vers le spot (l’endroit où on veut décoller). Les jambes sont fléchies, prêtes à donner une impulsion.

2. Pour déclencher le Ollie, il faut tirer sur la jambe avant tout en appuyant sur la jambe arrière pour déformer la planche et aller chercher le pop de son snowboard (le «rebond» de la planche). On peut s\'aider des bras en les dépliants comme un oiseau qui cherche à s\'envoler ;)

3. Dés que l’on sent qu’on décolle, il faut regrouper les jambes et les bras pour gagner en stabilité, le regard cherche déjà l’endroit où on va aller atterrir tout en essayant de profiter du moment présent…

4.  Pour atterrir, il faut légèrement détendre les jambes pour aller chercher le sol tout en préparant l’amorti, c’est à dire forcer sur les jambes qui servent d’amortisseur. Bien plier les genoux sans se laisser assoir par la force de gravité.

Le mieux c’est de commencer à s’entrainer à faire des ollies à plat sur la piste, puis en profitant des petits reliefs de bord de piste. Quand on se sent vraiment  à l’aise, on peut commencer à essayer sur de plus gros sauts (kickers de snowpark par exemple). Ne pas hésiter à être créatif, repérer toute variation de terrain qui peut être un bon spot pour envoyer un ollie, et transformer la montagne en terrain de jeu…');
        $manager->persist($ollie);

        $manager->flush();


    }
}