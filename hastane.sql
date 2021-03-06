USE [hastane]
GO
/****** Object:  User [yilmaz]    Script Date: 6.01.2022 09:46:40 ******/
CREATE USER [yilmaz] FOR LOGIN [yilmaz] WITH DEFAULT_SCHEMA=[dbo]
GO
/****** Object:  Schema [hastane]    Script Date: 6.01.2022 09:46:40 ******/
CREATE SCHEMA [hastane]
GO
/****** Object:  Table [hastane].[doktor]    Script Date: 6.01.2022 09:46:40 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [hastane].[doktor](
	[ID] [int] IDENTITY(18,1) NOT NULL,
	[DAL_NO] [int] NULL,
	[AD] [nvarchar](15) NOT NULL,
	[SOYAD] [nvarchar](15) NOT NULL,
 CONSTRAINT [PK_doktor_dr_no] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [hastane].[hasta]    Script Date: 6.01.2022 09:46:40 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [hastane].[hasta](
	[ID] [int] IDENTITY(1,1) NOT NULL,
	[h_ad] [nvarchar](15) NOT NULL,
	[h_soyad] [nvarchar](20) NOT NULL,
	[h_tcno] [nvarchar](50) NOT NULL,
	[h_cinsiyet] [nvarchar](5) NOT NULL,
	[h_telno] [float] NOT NULL,
	[h_dogum_tarihi] [date] NOT NULL,
 CONSTRAINT [PK_hasta_kayit_no] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [hastane].[ilac]    Script Date: 6.01.2022 09:46:40 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [hastane].[ilac](
	[ID] [int] IDENTITY(13,1) NOT NULL,
	[ilac_ad] [nvarchar](50) NOT NULL,
	[ilac_barkod_no] [float] NOT NULL,
	[ilac_miktar] [int] NOT NULL,
	[ilac_tipi] [nvarchar](15) NOT NULL,
 CONSTRAINT [PK_ilac_ilac_no] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [hastane].[pol_dal]    Script Date: 6.01.2022 09:46:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [hastane].[pol_dal](
	[ID] [int] IDENTITY(9,1) NOT NULL,
	[pol_ad] [nvarchar](25) NOT NULL,
 CONSTRAINT [PK_pol_dal_pol_no] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [hastane].[pol_kayit]    Script Date: 6.01.2022 09:46:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [hastane].[pol_kayit](
	[ID] [int] IDENTITY(9,1) NOT NULL,
	[pol_no] [int] NOT NULL,
	[dr_no] [int] NOT NULL,
	[hasta_id] [int] NULL,
	[tani] [nvarchar](30) NULL,
	[h_kayit_tarihi] [date] NULL,
	[h_cikis_tarihi] [date] NULL,
	[taburcu_durumu] [char](1) NULL,
 CONSTRAINT [PK_pol_kayit_kayit_no] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [hastane].[recete]    Script Date: 6.01.2022 09:46:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [hastane].[recete](
	[ID] [int] IDENTITY(11,1) NOT NULL,
	[ilac_no] [int] NOT NULL,
	[kayit_no] [int] NOT NULL,
	[kul_suresi] [int] NOT NULL,
	[dozaj] [int] NOT NULL,
 CONSTRAINT [PK_recete_recete_no] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [hastane].[silinmis_ilac_kayitlari]    Script Date: 6.01.2022 09:46:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [hastane].[silinmis_ilac_kayitlari](
	[ID] [int] NOT NULL,
	[ilac_ad] [nvarchar](50) NULL,
	[ilac_barkod_no] [float] NULL,
	[ilac_miktar] [nvarchar](50) NULL,
	[ilac_tipi] [nvarchar](50) NULL,
 CONSTRAINT [PK_silinmis_ilac_kayitlari] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [hastane].[tblayar]    Script Date: 6.01.2022 09:46:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [hastane].[tblayar](
	[ID] [int] NOT NULL,
	[baslik] [varchar](255) NULL,
	[aciklama] [varchar](255) NULL,
	[anahtar] [varchar](255) NULL,
	[url] [varchar](255) NULL,
	[telefon1] [varchar](255) NULL,
	[telefon2] [varchar](255) NULL,
 CONSTRAINT [PK_tblayar] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [hastane].[tblyetkiler]    Script Date: 6.01.2022 09:46:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [hastane].[tblyetkiler](
	[ID] [int] NOT NULL,
	[YETKIAD] [varchar](50) NULL,
	[ACIKLAMA] [varchar](50) NULL,
PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [hastane].[users]    Script Date: 6.01.2022 09:46:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [hastane].[users](
	[ID] [int] IDENTITY(4,1) NOT NULL,
	[kullaniciAdi] [nvarchar](30) NOT NULL,
	[sifre] [nvarchar](30) NOT NULL,
	[KULLANICIYETKI] [int] NULL,
	[AD] [varchar](50) NULL,
	[SOYAD] [varchar](50) NULL,
	[MAIL] [varchar](50) NULL,
	[KAYITTARIHI] [date] NULL,
	[FOTOGRAF] [nvarchar](250) NULL,
	[TCNO] [char](11) NULL,
 CONSTRAINT [PK_users_id] PRIMARY KEY CLUSTERED 
(
	[ID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [hastane].[doktor] ON 

INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (1, 5, N'Mustafa', N'Albayrak')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (2, 2, N'Merve', N'Koç')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (3, 3, N'Cem', N'Saygın')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (5, 5, N'Cüneyt', N'Şaşmaz')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (6, 6, N'Gözde', N'Yılmaz')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (7, 7, N'Murat', N'Saygılı')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (8, 2, N'Yunus Emre', N'Erken')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (9, 3, N'Emre', N'Kara')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (10, 4, N'Mehmet', N'Kaya')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (11, 5, N'Veli', N'Boyacı')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (12, 6, N'Mahmut', N'Arslan')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (15, 7, N'Yusuf', N'Okur')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (16, 8, N'Hazal', N'Karadeniz')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (17, NULL, N'Selda', N'Yazar')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (18, 2, N'sdfd', N'sdf')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (20, 2, N'Cafer', N'Elibol')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (21, 3, N'Yılmaz', N'Kadan')
INSERT [hastane].[doktor] ([ID], [DAL_NO], [AD], [SOYAD]) VALUES (22, 6, N'Emine', N'Erdoğdu')
SET IDENTITY_INSERT [hastane].[doktor] OFF
GO
SET IDENTITY_INSERT [hastane].[hasta] ON 

INSERT [hastane].[hasta] ([ID], [h_ad], [h_soyad], [h_tcno], [h_cinsiyet], [h_telno], [h_dogum_tarihi]) VALUES (7, N'Yusuf', N'Okur', N'12369584785', N'Erkek', 5494565656, CAST(N'1994-08-08' AS Date))
INSERT [hastane].[hasta] ([ID], [h_ad], [h_soyad], [h_tcno], [h_cinsiyet], [h_telno], [h_dogum_tarihi]) VALUES (8, N'Salih', N'Kösali', N'45698532547', N'Erkek', 5443156171, CAST(N'1993-05-12' AS Date))
INSERT [hastane].[hasta] ([ID], [h_ad], [h_soyad], [h_tcno], [h_cinsiyet], [h_telno], [h_dogum_tarihi]) VALUES (9, N'Muzaffer', N'Kadan', N'30342559850', N'Erkek', 5358793574, CAST(N'1974-01-01' AS Date))
SET IDENTITY_INSERT [hastane].[hasta] OFF
GO
SET IDENTITY_INSERT [hastane].[ilac] ON 

INSERT [hastane].[ilac] ([ID], [ilac_ad], [ilac_barkod_no], [ilac_miktar], [ilac_tipi]) VALUES (1, N'Allersol', 49873231521, 7, N'Göz Damlası')
INSERT [hastane].[ilac] ([ID], [ilac_ad], [ilac_barkod_no], [ilac_miktar], [ilac_tipi]) VALUES (2, N'Andolor', 87564512341, 26, N'Tablet')
INSERT [hastane].[ilac] ([ID], [ilac_ad], [ilac_barkod_no], [ilac_miktar], [ilac_tipi]) VALUES (3, N'Asomal', 84651538451, 7, N'Şurup')
INSERT [hastane].[ilac] ([ID], [ilac_ad], [ilac_barkod_no], [ilac_miktar], [ilac_tipi]) VALUES (5, N'Enflar', 12121545488, 16, N'Tablet')
INSERT [hastane].[ilac] ([ID], [ilac_ad], [ilac_barkod_no], [ilac_miktar], [ilac_tipi]) VALUES (6, N'Ezetrol', 21454515184, 15, N'Tablet')
INSERT [hastane].[ilac] ([ID], [ilac_ad], [ilac_barkod_no], [ilac_miktar], [ilac_tipi]) VALUES (7, N'Naponal', 57896415152, 18, N'Tablet')
INSERT [hastane].[ilac] ([ID], [ilac_ad], [ilac_barkod_no], [ilac_miktar], [ilac_tipi]) VALUES (9, N'Zovirax', 87415123333, 15, N'Krem')
INSERT [hastane].[ilac] ([ID], [ilac_ad], [ilac_barkod_no], [ilac_miktar], [ilac_tipi]) VALUES (10, N'Rinizol', 95454852224, 15, N'Burun Spreyi')
INSERT [hastane].[ilac] ([ID], [ilac_ad], [ilac_barkod_no], [ilac_miktar], [ilac_tipi]) VALUES (11, N'Vermidon', 8699516010720, 76, N'Tablet')
INSERT [hastane].[ilac] ([ID], [ilac_ad], [ilac_barkod_no], [ilac_miktar], [ilac_tipi]) VALUES (12, N'Aspirin', 8699516010722, 54, N'Tablet')
SET IDENTITY_INSERT [hastane].[ilac] OFF
GO
SET IDENTITY_INSERT [hastane].[pol_dal] ON 

INSERT [hastane].[pol_dal] ([ID], [pol_ad]) VALUES (2, N'Ortopedi')
INSERT [hastane].[pol_dal] ([ID], [pol_ad]) VALUES (3, N'Kardiyoloji')
INSERT [hastane].[pol_dal] ([ID], [pol_ad]) VALUES (4, N'Kulak Burun Boğaz')
INSERT [hastane].[pol_dal] ([ID], [pol_ad]) VALUES (5, N'Nöroloji')
INSERT [hastane].[pol_dal] ([ID], [pol_ad]) VALUES (6, N'Endotondi')
INSERT [hastane].[pol_dal] ([ID], [pol_ad]) VALUES (7, N'Psikiyatri')
INSERT [hastane].[pol_dal] ([ID], [pol_ad]) VALUES (8, N'Dahiliye 2')
INSERT [hastane].[pol_dal] ([ID], [pol_ad]) VALUES (9, N'Diş Hekimliği (Genel diş)')
SET IDENTITY_INSERT [hastane].[pol_dal] OFF
GO
SET IDENTITY_INSERT [hastane].[pol_kayit] ON 

INSERT [hastane].[pol_kayit] ([ID], [pol_no], [dr_no], [hasta_id], [tani], [h_kayit_tarihi], [h_cikis_tarihi], [taburcu_durumu]) VALUES (2, 8, 16, NULL, N'Uykuda Bağırma', CAST(N'2015-12-18' AS Date), CAST(N'2015-12-19' AS Date), N'0')
INSERT [hastane].[pol_kayit] ([ID], [pol_no], [dr_no], [hasta_id], [tani], [h_kayit_tarihi], [h_cikis_tarihi], [taburcu_durumu]) VALUES (3, 4, 10, NULL, N'Körlük', CAST(N'2015-12-18' AS Date), CAST(N'2015-12-31' AS Date), N'0')
INSERT [hastane].[pol_kayit] ([ID], [pol_no], [dr_no], [hasta_id], [tani], [h_kayit_tarihi], [h_cikis_tarihi], [taburcu_durumu]) VALUES (4, 4, 4, NULL, N'Astigmatizm', CAST(N'2015-12-19' AS Date), CAST(N'2015-12-30' AS Date), N'0')
INSERT [hastane].[pol_kayit] ([ID], [pol_no], [dr_no], [hasta_id], [tani], [h_kayit_tarihi], [h_cikis_tarihi], [taburcu_durumu]) VALUES (5, 7, 2, NULL, N'Sivilce', CAST(N'2015-12-22' AS Date), CAST(N'2015-12-29' AS Date), N'0')
INSERT [hastane].[pol_kayit] ([ID], [pol_no], [dr_no], [hasta_id], [tani], [h_kayit_tarihi], [h_cikis_tarihi], [taburcu_durumu]) VALUES (7, 5, 5, NULL, N'Yeni Tanı', CAST(N'2015-12-27' AS Date), CAST(N'2016-01-01' AS Date), N'0')
INSERT [hastane].[pol_kayit] ([ID], [pol_no], [dr_no], [hasta_id], [tani], [h_kayit_tarihi], [h_cikis_tarihi], [taburcu_durumu]) VALUES (8, 2, 2, NULL, N'yeni tanı', CAST(N'2015-12-30' AS Date), CAST(N'2015-12-31' AS Date), N'0')
INSERT [hastane].[pol_kayit] ([ID], [pol_no], [dr_no], [hasta_id], [tani], [h_kayit_tarihi], [h_cikis_tarihi], [taburcu_durumu]) VALUES (9, 2, 1, NULL, N'cafer', CAST(N'2022-01-04' AS Date), NULL, N'0')
INSERT [hastane].[pol_kayit] ([ID], [pol_no], [dr_no], [hasta_id], [tani], [h_kayit_tarihi], [h_cikis_tarihi], [taburcu_durumu]) VALUES (10, 2, 1, NULL, N'Deneme tanı', CAST(N'2022-01-04' AS Date), NULL, N'0')
INSERT [hastane].[pol_kayit] ([ID], [pol_no], [dr_no], [hasta_id], [tani], [h_kayit_tarihi], [h_cikis_tarihi], [taburcu_durumu]) VALUES (12, 4, 5, 8, N'Canı sıkılmış', CAST(N'2022-01-04' AS Date), NULL, N'0')
INSERT [hastane].[pol_kayit] ([ID], [pol_no], [dr_no], [hasta_id], [tani], [h_kayit_tarihi], [h_cikis_tarihi], [taburcu_durumu]) VALUES (13, 4, 1, 9, N'Hastalanmış', CAST(N'2022-01-05' AS Date), NULL, N'0')
INSERT [hastane].[pol_kayit] ([ID], [pol_no], [dr_no], [hasta_id], [tani], [h_kayit_tarihi], [h_cikis_tarihi], [taburcu_durumu]) VALUES (14, 6, 6, 8, N'Diş ağrısı', CAST(N'2022-01-05' AS Date), NULL, N'0')
SET IDENTITY_INSERT [hastane].[pol_kayit] OFF
GO
SET IDENTITY_INSERT [hastane].[recete] ON 

INSERT [hastane].[recete] ([ID], [ilac_no], [kayit_no], [kul_suresi], [dozaj]) VALUES (1, 3, 2, 14, 1)
INSERT [hastane].[recete] ([ID], [ilac_no], [kayit_no], [kul_suresi], [dozaj]) VALUES (2, 6, 2, 7, 3)
INSERT [hastane].[recete] ([ID], [ilac_no], [kayit_no], [kul_suresi], [dozaj]) VALUES (7, 12, 5, 7, 1)
INSERT [hastane].[recete] ([ID], [ilac_no], [kayit_no], [kul_suresi], [dozaj]) VALUES (9, 10, 7, 7, 3)
INSERT [hastane].[recete] ([ID], [ilac_no], [kayit_no], [kul_suresi], [dozaj]) VALUES (10, 11, 7, 14, 3)
INSERT [hastane].[recete] ([ID], [ilac_no], [kayit_no], [kul_suresi], [dozaj]) VALUES (11, 1, 12, 30, 2)
INSERT [hastane].[recete] ([ID], [ilac_no], [kayit_no], [kul_suresi], [dozaj]) VALUES (12, 5, 13, 23, 2)
INSERT [hastane].[recete] ([ID], [ilac_no], [kayit_no], [kul_suresi], [dozaj]) VALUES (13, 11, 14, 10, 20)
SET IDENTITY_INSERT [hastane].[recete] OFF
GO
INSERT [hastane].[silinmis_ilac_kayitlari] ([ID], [ilac_ad], [ilac_barkod_no], [ilac_miktar], [ilac_tipi]) VALUES (4, N'Asiviral', 54215454154, N'0', N'Krem')
INSERT [hastane].[silinmis_ilac_kayitlari] ([ID], [ilac_ad], [ilac_barkod_no], [ilac_miktar], [ilac_tipi]) VALUES (8, N'Perebron', 94512200000, N'7', N'Surup')
GO
INSERT [hastane].[tblayar] ([ID], [baslik], [aciklama], [anahtar], [url], [telefon1], [telefon2]) VALUES (1, N'Hastane Sistemi', N'Hastane yönetim sistemi', N'hastane yönetim', N'http://localhost/VTYS/yonetimpaneli/', N'2222222222', N'22222222')
GO
INSERT [hastane].[tblyetkiler] ([ID], [YETKIAD], [ACIKLAMA]) VALUES (1, N'User', N'1234')
INSERT [hastane].[tblyetkiler] ([ID], [YETKIAD], [ACIKLAMA]) VALUES (2, N'Hemsire', N'Hemsire')
INSERT [hastane].[tblyetkiler] ([ID], [YETKIAD], [ACIKLAMA]) VALUES (4, N'Admin', N'Admin')
GO
SET IDENTITY_INSERT [hastane].[users] ON 

INSERT [hastane].[users] ([ID], [kullaniciAdi], [sifre], [KULLANICIYETKI], [AD], [SOYAD], [MAIL], [KAYITTARIHI], [FOTOGRAF], [TCNO]) VALUES (1, N'kadan8080@gmail.com', N'cafer', 4, N'Yilmaz', N'Babacan', N'kadan8080@gmail.com', CAST(N'2021-08-13' AS Date), N'161d2ef8738a28.jpg', N'848454855  ')
INSERT [hastane].[users] ([ID], [kullaniciAdi], [sifre], [KULLANICIYETKI], [AD], [SOYAD], [MAIL], [KAYITTARIHI], [FOTOGRAF], [TCNO]) VALUES (2, N'hasta_kayit1', N'kayit_pass1', 2, N'Cafer', N'Elibol', N'cafer@gmail.com', NULL, NULL, N'43528423494')
INSERT [hastane].[users] ([ID], [kullaniciAdi], [sifre], [KULLANICIYETKI], [AD], [SOYAD], [MAIL], [KAYITTARIHI], [FOTOGRAF], [TCNO]) VALUES (3, N'hasta_kayit2', N'kayit_pass2', NULL, NULL, NULL, NULL, NULL, NULL, NULL)
INSERT [hastane].[users] ([ID], [kullaniciAdi], [sifre], [KULLANICIYETKI], [AD], [SOYAD], [MAIL], [KAYITTARIHI], [FOTOGRAF], [TCNO]) VALUES (5, N'abdul@gmail.com', N'15155', 4, N'Abdülkadir', N'Insan', N'abdul@gmail.com', NULL, NULL, N'15975345   ')
INSERT [hastane].[users] ([ID], [kullaniciAdi], [sifre], [KULLANICIYETKI], [AD], [SOYAD], [MAIL], [KAYITTARIHI], [FOTOGRAF], [TCNO]) VALUES (6, N'onur@gmail.com', N'159753', 1, N'Onur', N'Babacan', N'onur@gmail.com', NULL, NULL, N'159753658  ')
SET IDENTITY_INSERT [hastane].[users] OFF
GO
/****** Object:  Index [ilac$ilac_barkod_no]    Script Date: 6.01.2022 09:46:41 ******/
ALTER TABLE [hastane].[ilac] ADD  CONSTRAINT [ilac$ilac_barkod_no] UNIQUE NONCLUSTERED 
(
	[ilac_barkod_no] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
SET ANSI_PADDING ON
GO
/****** Object:  Index [users$username]    Script Date: 6.01.2022 09:46:41 ******/
ALTER TABLE [hastane].[users] ADD  CONSTRAINT [users$username] UNIQUE NONCLUSTERED 
(
	[kullaniciAdi] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, SORT_IN_TEMPDB = OFF, IGNORE_DUP_KEY = OFF, ONLINE = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
GO
ALTER TABLE [hastane].[doktor] ADD  DEFAULT (NULL) FOR [DAL_NO]
GO
ALTER TABLE [hastane].[pol_kayit] ADD  CONSTRAINT [DF__pol_kayit__tani__534D60F1]  DEFAULT (N'girilmemiş') FOR [tani]
GO
ALTER TABLE [hastane].[pol_kayit] ADD  CONSTRAINT [DF__pol_kayit__h_kay__5441852A]  DEFAULT (NULL) FOR [h_kayit_tarihi]
GO
ALTER TABLE [hastane].[pol_kayit] ADD  CONSTRAINT [DF__pol_kayit__h_cik__5535A963]  DEFAULT (NULL) FOR [h_cikis_tarihi]
GO
ALTER TABLE [hastane].[pol_kayit] ADD  CONSTRAINT [DF_pol_kayit_taburcu_durumu]  DEFAULT ((0)) FOR [taburcu_durumu]
GO
ALTER TABLE [hastane].[users] ADD  CONSTRAINT [DF_users_KULLANICIYETKI]  DEFAULT ((1)) FOR [KULLANICIYETKI]
GO
ALTER TABLE [hastane].[doktor]  WITH NOCHECK ADD  CONSTRAINT [doktor$doktor_ibfk_1] FOREIGN KEY([DAL_NO])
REFERENCES [hastane].[pol_dal] ([ID])
ON UPDATE CASCADE
ON DELETE SET NULL
GO
ALTER TABLE [hastane].[doktor] CHECK CONSTRAINT [doktor$doktor_ibfk_1]
GO
ALTER TABLE [hastane].[pol_kayit]  WITH CHECK ADD  CONSTRAINT [FK_pol_kayit_hasta] FOREIGN KEY([hasta_id])
REFERENCES [hastane].[hasta] ([ID])
ON UPDATE CASCADE
ON DELETE CASCADE
GO
ALTER TABLE [hastane].[pol_kayit] CHECK CONSTRAINT [FK_pol_kayit_hasta]
GO
ALTER TABLE [hastane].[pol_kayit]  WITH NOCHECK ADD  CONSTRAINT [pol_kayit$pol_kayit_ibfk_1] FOREIGN KEY([pol_no])
REFERENCES [hastane].[pol_dal] ([ID])
GO
ALTER TABLE [hastane].[pol_kayit] CHECK CONSTRAINT [pol_kayit$pol_kayit_ibfk_1]
GO
ALTER TABLE [hastane].[recete]  WITH CHECK ADD  CONSTRAINT [FK_recete_ilac] FOREIGN KEY([ilac_no])
REFERENCES [hastane].[ilac] ([ID])
GO
ALTER TABLE [hastane].[recete] CHECK CONSTRAINT [FK_recete_ilac]
GO
ALTER TABLE [hastane].[recete]  WITH CHECK ADD  CONSTRAINT [FK_recete_pol_kayit] FOREIGN KEY([kayit_no])
REFERENCES [hastane].[pol_kayit] ([ID])
GO
ALTER TABLE [hastane].[recete] CHECK CONSTRAINT [FK_recete_pol_kayit]
GO
ALTER TABLE [hastane].[users]  WITH CHECK ADD  CONSTRAINT [FK_users_tblyetkiler] FOREIGN KEY([KULLANICIYETKI])
REFERENCES [hastane].[tblyetkiler] ([ID])
GO
ALTER TABLE [hastane].[users] CHECK CONSTRAINT [FK_users_tblyetkiler]
GO
/****** Object:  StoredProcedure [dbo].[doktorlariGetir]    Script Date: 6.01.2022 09:46:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE Proc [dbo].[doktorlariGetir]
as

Begin

(SELECT doktor.*, pol_dal.pol_ad as pol_ad from hastane.doktor doktor INNER JOIN hastane.pol_dal pol_dal
                                    
        ON  doktor.ID = pol_dal.ID)

End
GO
/****** Object:  StoredProcedure [hastane].[hastaCikis]    Script Date: 6.01.2022 09:46:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
/*
*   SSMA informational messages:
*   M2SS0003: The following SQL clause was ignored during conversion:
*   DEFINER = `root`@`localhost`.
*/

CREATE PROCEDURE [hastane].[hastaCikis]  
   @kayitNo int
AS 
   BEGIN

      SET  XACT_ABORT  ON

      SET  NOCOUNT  ON

      UPDATE hastane.pol_kayit
         SET 
            h_cikis_tarihi = CAST(getdate() AS DATE)
      WHERE pol_kayit.kayit_no = @kayitNo

   END
GO
/****** Object:  StoredProcedure [hastane].[hastaKayit]    Script Date: 6.01.2022 09:46:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
/*
*   SSMA informational messages:
*   M2SS0003: The following SQL clause was ignored during conversion:
*   DEFINER = `root`@`localhost`.
*/

CREATE PROCEDURE [hastane].[hastaKayit]  
   @kayitNo int,
   @ad nvarchar(15),
   @soyad nvarchar(20),
   @tcno float(53),
   @cinsiyet nvarchar(5),
   @telno float(53),
   @dtarihi date,
   @il nvarchar(15),
   @ilce nvarchar(15),
   @mahalle nvarchar(15),
   @sokak nvarchar(15),
   @bina nvarchar(15),
   @daire int,
   @polNo int,
   @drNo int
AS 
   BEGIN

      SET  XACT_ABORT  ON

      SET  NOCOUNT  ON

      INSERT hastane.pol_kayit(kayit_no, pol_no, dr_no)
         VALUES (@kayitNo, @polNo, @drNo)

      /*
      *   SSMA informational messages:
      *   M2SS0231: Zero-date, zero-in-date and invalid dates to not null columns has been replaced with GetDate()/Constant date
      */

      INSERT hastane.hasta(
         kayit_no, 
         h_ad, 
         h_soyad, 
         h_tcno, 
         h_cinsiyet, 
         h_telno, 
         h_dogum_tarihi)
         VALUES (
            @kayitNo, 
            @ad, 
            @soyad, 
            @tcno, 
            @cinsiyet, 
            @telno, 
            isnull(@dtarihi, getdate()))

      INSERT hastane.adres(
         kayit_no, 
         il, 
         ilce, 
         mahalle, 
         sokak, 
         bina, 
         daire)
         VALUES (
            @kayitNo, 
            @il, 
            @ilce, 
            @mahalle, 
            @sokak, 
            @bina, 
            @daire)

   END
GO
/****** Object:  StoredProcedure [hastane].[taniGiris]    Script Date: 6.01.2022 09:46:41 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
/*
*   SSMA informational messages:
*   M2SS0003: The following SQL clause was ignored during conversion:
*   DEFINER = `root`@`localhost`.
*   M2SS0003: The following SQL clause was ignored during conversion:
*   NO SQL.
*/

CREATE PROCEDURE [hastane].[taniGiris]  
   @gTani nvarchar(30),
   @kayitNo int
AS 
   BEGIN

      SET  XACT_ABORT  ON

      SET  NOCOUNT  ON

      UPDATE hastane.pol_kayit
         SET 
            tani = @gTani
      WHERE pol_kayit.kayit_no = @kayitNo

   END
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'hastane.hastaCikis' , @level0type=N'SCHEMA',@level0name=N'hastane', @level1type=N'PROCEDURE',@level1name=N'hastaCikis'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'hastane.hastaKayit' , @level0type=N'SCHEMA',@level0name=N'hastane', @level1type=N'PROCEDURE',@level1name=N'hastaKayit'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'hastane.taniGiris' , @level0type=N'SCHEMA',@level0name=N'hastane', @level1type=N'PROCEDURE',@level1name=N'taniGiris'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'hastane.doktor' , @level0type=N'SCHEMA',@level0name=N'hastane', @level1type=N'TABLE',@level1name=N'doktor'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'hastane.hasta' , @level0type=N'SCHEMA',@level0name=N'hastane', @level1type=N'TABLE',@level1name=N'hasta'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'hastane.ilac' , @level0type=N'SCHEMA',@level0name=N'hastane', @level1type=N'TABLE',@level1name=N'ilac'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'hastane.pol_dal' , @level0type=N'SCHEMA',@level0name=N'hastane', @level1type=N'TABLE',@level1name=N'pol_dal'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'hastane.pol_kayit' , @level0type=N'SCHEMA',@level0name=N'hastane', @level1type=N'TABLE',@level1name=N'pol_kayit'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'hastane.recete' , @level0type=N'SCHEMA',@level0name=N'hastane', @level1type=N'TABLE',@level1name=N'recete'
GO
EXEC sys.sp_addextendedproperty @name=N'MS_SSMA_SOURCE', @value=N'hastane.users' , @level0type=N'SCHEMA',@level0name=N'hastane', @level1type=N'TABLE',@level1name=N'users'
GO
