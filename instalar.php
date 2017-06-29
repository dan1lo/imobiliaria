<?
#########################################################
#Copyright © e-Mobiliária. Todos os direitos reservados.#
#########################################################
#                                                       #
#  Programa        : e-Mobiliária PHP                   #
#  Autor           : Moisés Bach B.                     #
#  E-mail          : moisbach@gmail.com                 #
#  Versão          : 2.5                                #
#  Modificado em   : 09/12/2005                         #
#  Copyright ©     : e-Mobiliária                       #
#                 WWW.ANIMABUSCA.COM/IMOBILIARIA        #
#########################################################
#ESTE SCRIPT NÃO PODE SER COPIADO SEM AUTORIZAÇÃO PRÉVIA#
#########################################################

require_once("configuracao_mysql.php");


$q1 = "DROP TABLE IF EXISTS re2_admin";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "CREATE TABLE re2_admin (
    AdminID varchar(50) NOT NULL,
    AdminPass varchar(32) NOT NULL,
    AdminName varchar(100) NOT NULL,
    AdminEmail varchar(150) NOT NULL,
   PRIMARY KEY (AdminID))";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_admin VALUES ('admin','admin','Sua empresa','seunome@seuemail.com.br')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "DROP TABLE IF EXISTS re2_agents";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "CREATE TABLE re2_agents (
    AgentID int(10) NOT NULL auto_increment,
    TipodeConta int(1) DEFAULT '0' NOT NULL,
    username varchar(50) NOT NULL,
    password varchar(32) NOT NULL,
    FirstName varchar(150) NOT NULL,
    LastName varchar(150) NOT NULL,
    resume text NOT NULL,
    phone varchar(50) NOT NULL,
    cellular varchar(50) NOT NULL,
    pager varchar(50) NOT NULL,
    ResumeImages text NOT NULL,
    email varchar(150) NOT NULL,
    logo varchar(255) NOT NULL,
    RegDate int(10) DEFAULT '0' NOT NULL,
    ExpDate int(10) DEFAULT '0' NOT NULL,
    AccountStatus varchar(20) DEFAULT 'pending' NOT NULL,
    PriorityLevel int(1) DEFAULT '2' NOT NULL,
    offers int(3) DEFAULT '0' NOT NULL,
    news char(1) DEFAULT 'y' NOT NULL,
    NewsletterType varchar(10) DEFAULT 'plain' NOT NULL,
    days10 char(1) DEFAULT 'n' NOT NULL,
    days5 char(1) DEFAULT 'n' NOT NULL,
    days1 char(1) DEFAULT 'n' NOT NULL,
   PRIMARY KEY (AgentID),
   UNIQUE email (email),
   UNIQUE username (username))";

mysql_query($q1) or die(mysql_error()." at row ".__LINE__);


$q1 = "DROP TABLE IF EXISTS re2_banners";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "CREATE TABLE re2_banners (
    ClientID int(10) DEFAULT '0' NOT NULL,
    BannerID int(10) NOT NULL auto_increment,
    BannerURL varchar(255) NOT NULL,
    BannerFile varchar(255) NOT NULL,
    BannerAlt varchar(255) NOT NULL,
    BannerType varchar(50) NOT NULL,
    bCat int(10) DEFAULT '0' NOT NULL,
    bSub int(10) DEFAULT '0' NOT NULL,
   PRIMARY KEY (BannerID))";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);



$q1 = "DROP TABLE IF EXISTS re2_categories";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "CREATE TABLE re2_categories (
    CategoryID int(10) NOT NULL auto_increment,
    CategoryName varchar(255) NOT NULL,
   PRIMARY KEY (CategoryID),
   UNIQUE CategoryName (CategoryName))";


mysql_query($q1) or die(mysql_error()." at row ".__LINE__);


$q1 = "INSERT INTO re2_categories VALUES ('3','Vende-se')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_categories VALUES ('4','Aluga-se')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);




$q1 = "DROP TABLE IF EXISTS re2_listings";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "CREATE TABLE re2_listings (
    ListingID int(10) NOT NULL auto_increment,
    AgentID int(10) DEFAULT '0' NOT NULL,
    CategoryID int(10) DEFAULT '0' NOT NULL,
    SubcategoryID int(10) DEFAULT '0' NOT NULL,
    address text NOT NULL,
    city varchar(100) NOT NULL,
    state varchar(100) NOT NULL,
    country varchar(150) NOT NULL,
    ShortDesc text NOT NULL,
    DetailedDesc text NOT NULL,
    Price float(15,2) DEFAULT '0.00' NOT NULL,
    PropertyType varchar(50) NOT NULL,
    neighbourhood text NOT NULL,
    rooms int(2) DEFAULT '0' NOT NULL,
    bathrooms int(2) DEFAULT '0' NOT NULL,
    fireplace char(1) DEFAULT 'n' NOT NULL,
    garage int(2) DEFAULT '0' NOT NULL,
    SquareMeters float(15,2) DEFAULT '0.00' NOT NULL,
    LotSize float(15,2) DEFAULT '0.00' NOT NULL,
    HomeAge int(3) DEFAULT '0' NOT NULL,
    NearSchool char(1) DEFAULT 'n' NOT NULL,
    NearTransit char(1) DEFAULT 'n' NOT NULL,
    NearPark char(1) DEFAULT 'n' NOT NULL,
    OceanView char(1) DEFAULT 'n' NOT NULL,
    LakeView char(1) DEFAULT 'n' NOT NULL,
    MountainView char(1) DEFAULT 'n' NOT NULL,
    OceanWaterfront char(1) DEFAULT 'n' NOT NULL,
    LakeWaterfront char(1) DEFAULT 'n' NOT NULL,
    RiverWaterfront char(1) DEFAULT 'n' NOT NULL,
    image text NOT NULL,
    DateAdded int(10) DEFAULT '0' NOT NULL,
    visits int(10) DEFAULT '0' NOT NULL,
   PRIMARY KEY (ListingID))";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "DROP TABLE IF EXISTS re2_mail_archive";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "CREATE TABLE re2_mail_archive (
    subject varchar(255) NOT NULL,
    message text,
    MailDate int(10) DEFAULT '0' NOT NULL)";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);



$q1 = "DROP TABLE IF EXISTS re2_prices";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "CREATE TABLE re2_prices (
    PackageName varchar(50) NOT NULL,
    PriceID int(10) NOT NULL auto_increment,
    PriceValue float(5,2) DEFAULT '0.00' NOT NULL,
    Duration varchar(10) NOT NULL,
    PriorityLevel int(1) DEFAULT '0' NOT NULL,
    PriceType varchar(10) DEFAULT '0' NOT NULL,
    offers int(10) DEFAULT '0' NOT NULL,
   PRIMARY KEY (PriceID))";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);


$q1 = "INSERT INTO re2_prices VALUES ('Plano Imobiliária Bronze','7','14.95','1','1','Imob.','5')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_prices VALUES ('Plano Anúncios privados','9','9.95','1','1','Privado','1')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);


$q1 = "INSERT INTO re2_prices VALUES ('Plano Imobiliária Ouro','11','39.95','1','1','Imob.','20')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);


$q1 = "DROP TABLE IF EXISTS re2_priority";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "CREATE TABLE re2_priority (
    PriorityID int(10) NOT NULL auto_increment,
    PriorityName varchar(50) NOT NULL,
    PriorityLevel int(1) DEFAULT '0' NOT NULL,
   PRIMARY KEY (PriorityID),
   UNIQUE PriorityName (PriorityName))";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_priority VALUES ('1','Padrão','1')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);


$q1 = "DROP TABLE IF EXISTS re2_settings";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "CREATE TABLE re2_settings (
    id int(1) DEFAULT '0' NOT NULL,
    SiteTitle varchar(255) NOT NULL,
    SiteName varchar(255) NOT NULL,
    SiteKeywords varchar(255) NOT NULL,
    SiteDescription text,
    ContactEmail varchar(150) NOT NULL,
    CompanyAddress text,
    PayPalEmail varchar(150) NOT NULL,
    SellerID int(5) DEFAULT '0' NOT NULL,
    Agreement text NOT NULL,
	Clientes text NOT NULL,
    Parceiros text NOT NULL,
    sp_vendor_email varchar(255) NOT NULL,
    sp_payee_email varchar(255) NOT NULL,
    sp_secret_code varchar(255) NOT NULL)";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_settings VALUES (1, 'Minha Imobiliária LTDA.', 'Minha Imobiliária LTDA.', 'imobiliaria, vendas, aluguel, a venda, aluga-se, casa, casas, apartamento, estúdio, salas', 'Encontre o imóvel dos seus sonhos para vender ou alugar', 'seunome@seuemail.com.br', 'Minha rua tal tal 123/r/n Cidade: taltal, /r /n', 'seunome@seuemail.com.br', 1234, '<strong>Condições de uso do site >> ATENÇÃO ADMINISTRADOR: ALTERE ESTAS CONDIÇÕES NO PAINEL DE ADMINSITRAÇÃO!</strong><br> <p><br>nonononononononononononononononnonononononononononononononononnononononononono<br>nonononononononnonononononononononononononononnono<br>nononononononononononononon</p><p>nononononononononononononononon<br>nonononononononononononononononnonononononon<br>onononononononononnonononononononononononono<br>nononnononononononononononononononon</p<p>nonononononononononononono<br>nonon<br>nonononononononononononononononnononononononono<br>nonononononononnonononononononononononononononnono<br>nononononononononononon<br>ononnonononononononononononon<br>onononnonononononononononononon<br>onononnononononononononono<br>nonononononnonononononononononono<br>nononononnononononononono<br>nononononononon</p><p>nononononononononononononononon<br>nonononononononononononononononnononononononononono<br>nonononononnonononononononononon<br>onononononnonononononononononononononononnono<br>nononononononononononononon</p><p>nononononononononononononononon<br>nonononononononononononononono<br>nnononononononononononononononon<br>nonononononononononononononononnon<br>ononononononononononononononno<br>nononononononononononononononnon<br>onononononononononononononon</p><p><br></p>', 'ATENÇÃO ADMINISTRADOR: ALTERE ESTAS CONDIÇÕES NO PAINEL DE ADMINSITRAÇÃO!</strong><br> <p><br>nonononononononononononononononnonononononononononononononononnononononononono<br>nonononononononnonononononononononononononononnono<br>nononononononononononononon</p><p>nononononononononononononononon<br>nonononononononononononononononnonononononon<br>onononononononononnonononononononononononono<br>nononnononononononononononononononon</p<p>nonononononononononononono<br>nonon<br>nonononononononononononononononnononononononono<br>nonononononononnonononononononononononononononnono<br>nononononononononononon<br>ononnonononononononononononon<br>onononnonononononononononononon<br>onononnononononononononono<br>nonononononnonononononononononono<br>nononononnononononononono<br>nononononononon</p><p>nononononononononononononononon<br>nonononononononononononononononnononononononononono<br>nonononononnonononononononononon<br>onononononnonononononononononononononononnono<br>nononononononononononononon</p><p>nononononononononononononononon<br>nonononononononononononononono<br>nnononononononononononononononon<br>nonononononononononononononononnon<br>ononononononononononononononno<br>nononononononononononononononnon<br>onononononononononononononon</p><p><br></p>', 'ATENÇÃO ADMINISTRADOR: ALTERE ESTAS CONDIÇÕES NO PAINEL DE ADMINSITRAÇÃO!</strong><br> <p><br>nonononononononononononononononnonononononononononononononononnononononononono<br>nonononononononnonononononononononononononononnono<br>nononononononononononononon</p><p>nononononononononononononononon<br>nonononononononononononononononnonononononon<br>onononononononononnonononononononononononono<br>nononnononononononononononononononon</p<p>nonononononononononononono<br>nonon<br>nonononononononononononononononnononononononono<br>nonononononononnonononononononononononononononnono<br>nononononononononononon<br>ononnonononononononononononon<br>onononnonononononononononononon<br>onononnononononononononono<br>nonononononnonononononononononono<br>nononononnononononononono<br>nononononononon</p><p>nononononononononononononononon<br>nonononononononononononononononnononononononononono<br>nonononononnonononononononononon<br>onononononnonononononononononononononononnono<br>nononononononononononononon</p><p>nononononononononononononononon<br>nonononononononononononononono<br>nnononononononononononononononon<br>nonononononononononononononononnon<br>ononononononononononononononno<br>nononononononononononononononnon<br>onononononononononononononon</p><p><br></p>', '', '', '')";

mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "DROP TABLE IF EXISTS re2_stats";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "CREATE TABLE re2_stats (
    BannerID int(10) DEFAULT '0' NOT NULL,
    impressions int(10) DEFAULT '0' NOT NULL,
    clicks int(10) DEFAULT '0' NOT NULL,
    mydate int(10) DEFAULT '0' NOT NULL,
    ip varchar(50) NOT NULL)";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);


$q1 = "DROP TABLE IF EXISTS re2_subcategories";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "CREATE TABLE re2_subcategories (
    SubcategoryID int(10) NOT NULL auto_increment,
    SubcategoryName varchar(255) NOT NULL,
    CategoryID int(10) DEFAULT '0' NOT NULL,
   PRIMARY KEY (SubcategoryID))";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_subcategories VALUES ('3','Apartamentos/Suites','4')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_subcategories VALUES ('4','Casas/Duplexes','4')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_subcategories VALUES ('5','Fazendas/Lotes e Hectares','4')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_subcategories VALUES ('6','Garagens e Estacionamentos','4') ";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_subcategories VALUES ('7','Motor-Homes','4')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_subcategories VALUES ('8','Fora da cidade','4')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_subcategories VALUES ('9','Salas','4')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "DROP TABLE IF EXISTS re2_types";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "CREATE TABLE re2_types (
    TypeID int(10) NOT NULL auto_increment,
    TypeName varchar(100) NOT NULL,
   PRIMARY KEY (TypeID),
   UNIQUE TypeName (TypeName))";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);


$q1 = "INSERT INTO re2_types VALUES ('20','Fazenda')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_types VALUES ('19','Hectares')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_types VALUES ('18','Rancho')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_types VALUES ('17','Casa')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

$q1 = "INSERT INTO re2_types VALUES ('16','Salas')";
mysql_query($q1) or die(mysql_error()." at row ".__LINE__);

echo "<center><br><br><br><font face=verdana size=2 color=black><b>O banco de dados foi instalado com sucesso!<br><br>Agora delete este arquivo do seu servidor(instalar.php)</b></font></center>";

?>