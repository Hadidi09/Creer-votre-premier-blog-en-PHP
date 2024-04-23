# Lancer le projet sur votre pc

- Faire un git Clone du projet
- exécuter la commande : `composer install`
- Importer la base de données qui se trouve dans le fichier db.sql dans votre base de données Mysql.
- créé un fichier nommé `.env` pour y ajouter vos variables d'environnement comme ceci :
- `DB_HOST=Votre_Nom_D'hote`
- `DB_NAME=Votre_Base_De_Données`
- `DB_USERNAME=LeNom_de_votre_user`
- `DB_PASSWORD=votre_mot_de_passe`

- télécharger l'exécutable de mailHog , en vous rendant sur cette page :
  [Mailhog tutoriel](https://kinsta.com/fr/blog/mailhog/)
  vous pouvez suivre cet article qui vous aide à l'installer et le lancer
  https://github.com/mailhog/MailHog/releases. En choississant la version correspondant à votre OS
- Lancer l'executable de mailHog et rendez vous ici : http://localhost:8025/ pour intercépter les mails.
- Lancer pour intercepter les mails envoyés depuis votre pc.
- Depuis la racine du projet exécutez la commande
  `PHP -S localhost:8000`

## Description du besoin

### Le projet est donc de développer votre blog professionnel. Ce site web se décompose en deux grands groupes de pages :

    les pages utiles à tous les visiteurs ;
    les pages permettant d’administrer votre blog.

#### Voici la liste des pages qui devront être accessibles depuis votre site web :

    la page d'accueil ;
    la page listant l’ensemble des blog posts ;
    la page affichant un blog post ;
    la page permettant d’ajouter un blog post ;
    la page permettant de modifier un blog post ;
    les pages permettant de modifier/supprimer un blog post ;
    les pages de connexion/enregistrement des utilisateurs.
