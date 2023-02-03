# A partir de l'image docker officiel de PHP
FROM php
# Le répertoire de travail sera /app
# Le volume du container qui contient les fichiers sources de l'app Symfony
# sera également ce répertoire
WORKDIR /app
# Je lance la commande Linux permettant de mettre à jour les paquets
# Et installer le paquet wget
RUN  apt-get update && apt-get install -y wget && rm -rf /var/lib/apt/lists/*
# Grace a wget, je récupère le CLI de Symfony
RUN wget https://get.symfony.com/cli/installer -O - | bash
# Et je le déplace dans le répertoire /usr/local/bin pour pouvoir l'utiliser
RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony
# L'application Symfony sera accessible sur le port 8000
EXPOSE 8000
# Je lance le symfony serve
CMD symfony serve:start