/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     11/02/2020 19:42:24                          */
/*==============================================================*/


drop table if exists JASA_AIR;

drop table if exists JASA_IPKEAMANAN;

drop table if exists JASA_KEBERSIHAN;

drop table if exists JASA_LISTRIK;

drop table if exists KAL_AIR;

drop table if exists KAL_KEAMANAN;

drop table if exists KAL_KEBERSIHAN;

drop table if exists KAL_LISTRIK;

drop table if exists NASABAH;

drop table if exists TAGIHAN_AIR;

drop table if exists TAGIHAN_LISTRIK;

drop table if exists TARIF_AIR;

drop table if exists TARIF_IPK;

drop table if exists TARIF_KEAMANAN;

drop table if exists TARIF_KEBERSIHAN;

drop table if exists TARIF_LISTRIK;

drop table if exists TEMPAT_USAHA;

/*==============================================================*/
/* Table: JASA_AIR                                              */
/*==============================================================*/
create table JASA_AIR
(
   ID_JSAIR             int not null auto_increment,
   ID_TEMPAT            int,
   TGL_JSAIR            date not null,
   primary key (ID_JSAIR)
);

/*==============================================================*/
/* Table: JASA_IPKEAMANAN                                       */
/*==============================================================*/
create table JASA_IPKEAMANAN
(
   ID_JSIPKEAMANAN      int not null auto_increment,
   ID_TEMPAT            int,
   TGL_JSIPKEAMANAN     date not null,
   primary key (ID_JSIPKEAMANAN)
);

/*==============================================================*/
/* Table: JASA_KEBERSIHAN                                       */
/*==============================================================*/
create table JASA_KEBERSIHAN
(
   ID_JSKEBERSIHAN      int not null auto_increment,
   ID_TEMPAT            int,
   TGL_JSKEBERSIHAN     date not null,
   primary key (ID_JSKEBERSIHAN)
);

/*==============================================================*/
/* Table: JASA_LISTRIK                                          */
/*==============================================================*/
create table JASA_LISTRIK
(
   ID_JSLISTRIK         int not null auto_increment,
   ID_TEMPAT            int,
   TGL_JSLISTRIK        date not null,
   primary key (ID_JSLISTRIK)
);

/*==============================================================*/
/* Table: KAL_AIR                                               */
/*==============================================================*/
create table KAL_AIR
(
   ID_KALAIR            int not null auto_increment,
   ID_TRFAIR            int,
   ID_TGHAIR            int,
   TGL_KALAIR           date not null,
   AKHIR_AIR            int not null,
   PAKAI_AIR            int not null,
   BYR_AIR              int not null,
   BYR_PEMELIHARAAN     int not null,
   BYR_BEBAN            int not null,
   BYR_ARKOT            int not null,
   BULAN_AIR            varchar(20) not null,
   primary key (ID_KALAIR)
);

/*==============================================================*/
/* Table: KAL_KEAMANAN                                          */
/*==============================================================*/
create table KAL_KEAMANAN
(
   ID_KALKEAMANAN       int not null auto_increment,
   ID_JSIPKEAMANAN      int,
   TGL_KALKEAMANAN      date not null,
   BYR_KEAMANAN         int not null,
   BULAN_KEAMANAN       varchar(20) not null,
   primary key (ID_KALKEAMANAN)
);

/*==============================================================*/
/* Table: KAL_KEBERSIHAN                                        */
/*==============================================================*/
create table KAL_KEBERSIHAN
(
   ID_KALKEBERSIHAN     int not null auto_increment,
   ID_JSKEBERSIHAN      int,
   TGL_KALKEBERSIHAN    date not null,
   BYR_KEBERSIHAN       int not null,
   BULAN_KEBERSIHAN     varchar(20) not null,
   primary key (ID_KALKEBERSIHAN)
);

/*==============================================================*/
/* Table: KAL_LISTRIK                                           */
/*==============================================================*/
create table KAL_LISTRIK
(
   ID_KALLISTRIK        int not null auto_increment,
   ID_TGHLISTRIK        int,
   ID_TRFLISTRIK        int,
   primary key (ID_KALLISTRIK)
);

/*==============================================================*/
/* Table: NASABAH                                               */
/*==============================================================*/
create table NASABAH
(
   ID_NASABAH           int not null auto_increment,
   NM_NASABAH           varchar(25) not null,
   NO_KTP               varchar(20) not null,
   NO_NPWP              varchar(20) not null,
   NO_TLP               varchar(13) not null,
   primary key (ID_NASABAH)
);

/*==============================================================*/
/* Table: TAGIHAN_AIR                                           */
/*==============================================================*/
create table TAGIHAN_AIR
(
   ID_TGHAIR            int not null auto_increment,
   ID_JSAIR             int,
   AWAL_AIR             int not null,
   primary key (ID_TGHAIR)
);

/*==============================================================*/
/* Table: TAGIHAN_LISTRIK                                       */
/*==============================================================*/
create table TAGIHAN_LISTRIK
(
   ID_TGHLISTRIK        int not null auto_increment,
   ID_JSLISTRIK         int,
   AWAL_LISTRIK         int not null,
   primary key (ID_TGHLISTRIK)
);

/*==============================================================*/
/* Table: TARIF_AIR                                             */
/*==============================================================*/
create table TARIF_AIR
(
   ID_TRFAIR            int not null auto_increment,
   TRF_AIR1             int not null,
   TRF_AIR2             int not null,
   TRF_PEMELIHARAAN     int not null,
   TRF_BEBAN            int not null,
   TRF_ARKOT            int not null,
   TRF_DENDA            int not null,
   PPN_AIR              int not null,
   primary key (ID_TRFAIR)
);

/*==============================================================*/
/* Table: TARIF_IPK                                             */
/*==============================================================*/
create table TARIF_IPK
(
   ID_TRFIPK            int not null auto_increment,
   TRF_IPK              int not null,
   primary key (ID_TRFIPK)
);

/*==============================================================*/
/* Table: TARIF_KEAMANAN                                        */
/*==============================================================*/
create table TARIF_KEAMANAN
(
   ID_TRFKEAMANAN       int not null auto_increment,
   TRF_KEAMANAN         int not null,
   primary key (ID_TRFKEAMANAN)
);

/*==============================================================*/
/* Table: TARIF_KEBERSIHAN                                      */
/*==============================================================*/
create table TARIF_KEBERSIHAN
(
   ID_TRFKEBERSIHAN     int not null auto_increment,
   TRF_KEBERSIHAN       int not null,
   primary key (ID_TRFKEBERSIHAN)
);

/*==============================================================*/
/* Table: TARIF_LISTRIK                                         */
/*==============================================================*/
create table TARIF_LISTRIK
(
   ID_TRFLISTRIK        int not null auto_increment,
   VAR_BEBAN            int not null,
   VAR_BLOK1            int not null,
   VAR_BLOK2            int not null,
   VAR_STANDAR          int not null,
   VAR_BPJU             int not null,
   VAR_DENDA            int not null,
   PPN_LISTRIK          int not null,
   primary key (ID_TRFLISTRIK)
);

/*==============================================================*/
/* Table: TEMPAT_USAHA                                          */
/*==============================================================*/
create table TEMPAT_USAHA
(
   ID_TEMPAT            int not null auto_increment,
   ID_TRFKEBERSIHAN     int,
   ID_TRFKEAMANAN       int,
   ID_TRFIPK            int,
   ID_NASABAH           int,
   KD_KONTROL           varchar(15) not null,
   NO_ALAMAT            varchar(15) not null,
   JML_ALAMAT           int not null,
   NOMTR_LISTRIK        varchar(20),
   NOMTR_AIR            varchar(20),
   BENTUK_USAHA         varchar(20),
   primary key (ID_TEMPAT)
);

alter table JASA_AIR add constraint FK_RELATIONSHIP_4 foreign key (ID_TEMPAT)
      references TEMPAT_USAHA (ID_TEMPAT) on delete restrict on update restrict;

alter table JASA_IPKEAMANAN add constraint FK_RELATIONSHIP_5 foreign key (ID_TEMPAT)
      references TEMPAT_USAHA (ID_TEMPAT) on delete restrict on update restrict;

alter table JASA_KEBERSIHAN add constraint FK_RELATIONSHIP_24 foreign key (ID_TEMPAT)
      references TEMPAT_USAHA (ID_TEMPAT) on delete restrict on update restrict;

alter table JASA_LISTRIK add constraint FK_RELATIONSHIP_23 foreign key (ID_TEMPAT)
      references TEMPAT_USAHA (ID_TEMPAT) on delete restrict on update restrict;

alter table KAL_AIR add constraint FK_RELATIONSHIP_15 foreign key (ID_TGHAIR)
      references TAGIHAN_AIR (ID_TGHAIR) on delete restrict on update restrict;

alter table KAL_AIR add constraint FK_RELATIONSHIP_16 foreign key (ID_TRFAIR)
      references TARIF_AIR (ID_TRFAIR) on delete restrict on update restrict;

alter table KAL_KEAMANAN add constraint FK_RELATIONSHIP_13 foreign key (ID_JSIPKEAMANAN)
      references JASA_IPKEAMANAN (ID_JSIPKEAMANAN) on delete restrict on update restrict;

alter table KAL_KEBERSIHAN add constraint FK_RELATIONSHIP_14 foreign key (ID_JSKEBERSIHAN)
      references JASA_KEBERSIHAN (ID_JSKEBERSIHAN) on delete restrict on update restrict;

alter table KAL_LISTRIK add constraint FK_RELATIONSHIP_17 foreign key (ID_TGHLISTRIK)
      references TAGIHAN_LISTRIK (ID_TGHLISTRIK) on delete restrict on update restrict;

alter table KAL_LISTRIK add constraint FK_RELATIONSHIP_18 foreign key (ID_TRFLISTRIK)
      references TARIF_LISTRIK (ID_TRFLISTRIK) on delete restrict on update restrict;

alter table TAGIHAN_AIR add constraint FK_RELATIONSHIP_10 foreign key (ID_JSAIR)
      references JASA_AIR (ID_JSAIR) on delete restrict on update restrict;

alter table TAGIHAN_LISTRIK add constraint FK_RELATIONSHIP_9 foreign key (ID_JSLISTRIK)
      references JASA_LISTRIK (ID_JSLISTRIK) on delete restrict on update restrict;

alter table TEMPAT_USAHA add constraint FK_RELATIONSHIP_19 foreign key (ID_TRFKEBERSIHAN)
      references TARIF_KEBERSIHAN (ID_TRFKEBERSIHAN) on delete restrict on update restrict;

alter table TEMPAT_USAHA add constraint FK_RELATIONSHIP_20 foreign key (ID_TRFIPK)
      references TARIF_IPK (ID_TRFIPK) on delete restrict on update restrict;

alter table TEMPAT_USAHA add constraint FK_RELATIONSHIP_21 foreign key (ID_TRFKEAMANAN)
      references TARIF_KEAMANAN (ID_TRFKEAMANAN) on delete restrict on update restrict;

alter table TEMPAT_USAHA add constraint FK_RELATIONSHIP_22 foreign key (ID_NASABAH)
      references NASABAH (ID_NASABAH) on delete restrict on update restrict;

