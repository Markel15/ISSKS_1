# San Mamés Liburutegia

## Deskribapena
Web sistema honetan, erregistratu, izena eman eta zure datu pertsonalak alda ditzakezu. Gainera, liburutegi baten moduan, liburuak gehitu, ezabatu eta editatu ahal dira.

## Parte-hartzaileak
- Markel Hernandez
- Ander Vicario
- Iker Mujika
- Aitor Benito
- Irune Palacios
- Miriam Bergaz

## Docker-rentzako Jarraibideak

### Aurrebaldintza
Docker eta docker-compose zure sisteman aurretik instalatuta dauzkazula ziurtatu. [Docker](https://www.docker.com/get-started) instalatuta daukazula ziurtatu jarraitzeko.

### Proiektua Docker bidez Hedatzeko Pausuak

1. Klonatu biltegia zure makinan:

   ```bash
   $ git clone https://github.com/Markel15/ISSKS_1.git
   ```
   
2. Direktoriora joan eta "entrega_1" branch-a aukeratu:

   ```bash
   $ cd ./ISSKS_1
   $ git checkout entrega_2
   ```

3. Sortu Docker web irudia Dockerfile fitxategiaren bidez:

   ```bash
   $ docker build -t="web" .
   ```

   (Aurreitk sortutako irudi eta edukiontzi guztiak ezabatzeko:)
   ```bash
   $ docker stop $(docker ps -a -q) && docker rm $(docker ps -a -q) && docker rmi $(docker images -q)
   ```
   
5. Zerbitzuak hedatu:

   ```bash
   $ docker-compose up
   ```

6. Orain, zure proiektua web nabigatzaile batean bisita dezakezu hurrengo helbidetan:

   http://localhost:81 (web-sistema)
   http://localhost:8890 (phpmyadmin)
