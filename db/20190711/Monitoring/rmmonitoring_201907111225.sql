SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
SET ANSI_PADDING ON
GO
CREATE TABLE [dbo].[rmmonitoring](
    [id] [int] IDENTITY(1,1) NOT NULL,
    [personal_number] [varchar](10) NOT NULL,
    [rm_name] [varchar](100) NOT NULL,
    [division] [varchar](100) NULL,
    [account_planning_total] [varchar](100) NULL,
    [account_planning_list] [text] NULL,
    [account_planning_publish] [varchar](10) NULL,
    [account_planning_wa] [varchar](10) NULL,
    [account_planning_draft] [varchar](10) NULL,
    [account_planning_progress] [varchar](10) NULL,
PRIMARY KEY CLUSTERED 
(
    [id] ASC
)WITH (PAD_INDEX  = OFF, STATISTICS_NORECOMPUTE  = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS  = ON, ALLOW_PAGE_LOCKS  = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET ANSI_PADDING OFF
GO


INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00088375','Zickry Zulkifti','DIVISI BISNIS KORPORASI 1','7','[{"status":1,"customer_name":" Linkadata Citra Mandiri"},{"status":1,"customer_name":"AGUNG SEDAYU GROUP"},{"status":1,"customer_name":"Berau Karentindo Lestari"},{"status":1,"customer_name":"Ciputra Group"},{"status":1,"customer_name":"Eagle High Plantation Grup"},{"status":1,"customer_name":"Indonesia Dwi Sembilan"},{"status":1,"customer_name":"Perkebunan Kalimantan 1"}]','0','0','7','')
,('00059707','Mochamad Sukarno Pranoto','DIVISI BISNIS KORPORASI 1','2','[{"status":1,"customer_name":"Citra Sawit Lestari"},{"status":1,"customer_name":"Widodo Makmur Perkasa"}]','0','0','2','')
,('00069775','Rif ''ani Arzaq','DIVISI BISNIS KORPORASI 1','2','[{"status":1,"customer_name":"Bukit Berlian Grup"},{"status":1,"customer_name":"Royal Golden Eagle"}]','0','0','2','')
,('00072034','Adrianto Budi Pratomo','DIVISI BISNIS KORPORASI 1','2','[{"status":1,"customer_name":"Salim Grup"},{"status":1,"customer_name":"Toba Bara Grup"}]','0','0','2','')
,('00072578','Dani Hermawan','DIVISI BISNIS KORPORASI 1','1','[{"status":1,"customer_name":"MPE Grup"}]','0','0','1','')
,('00073137','Dicky Dahler','DIVISI BISNIS KORPORASI 1','2','[{"status":1,"customer_name":"Pradiksi Gunatama"},{"status":1,"customer_name":"Smart Grup"}]','0','0','2','')
,('00078335','Reviansyah Putra','DIVISI BISNIS KORPORASI 1','3','[{"status":1,"customer_name":"Gajendra Grup"},{"status":1,"customer_name":"KSK"},{"status":1,"customer_name":"Sampoerna Agro"}]','0','0','3','')
,('00079236','Fadel Muhammad','DIVISI BISNIS KORPORASI 1','3','[{"status":1,"customer_name":"Asam Jawa Grup"},{"status":1,"customer_name":"Patriot Grup"},{"status":1,"customer_name":"Provident Agro "}]','0','0','3','')
,('00203762','Muhammad Titiyan Satria','DIVISI BISNIS KORPORASI 1','3','[{"status":1,"customer_name":"Gozco Grup"},{"status":1,"customer_name":"Kalimantan Agro Pusaka"},{"status":1,"customer_name":"Mahameru Aksara Agri"}]','0','0','3','')
,('00059815','Y. Sigit Setyo Noviyanto','DIVISI BISNIS KORPORASI 1','1','[{"status":1,"customer_name":"Sarimas Grup"}]','0','0','1','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00070400','Tara Syafrendro','DIVISI BISNIS KORPORASI 1','0','[]','0','0','0','')
,('00072479','Pradipta Susilo Putra','DIVISI BISNIS KORPORASI 1','4','[{"status":1,"customer_name":"Bina Karya Prima"},{"status":1,"customer_name":"Buana Grup"},{"status":1,"customer_name":"Central Proteina Prima"},{"status":1,"customer_name":"Telaga Hikmah"}]','0','0','4','')
,('00072539','Mohamad Aliansyah','DIVISI BISNIS KORPORASI 1','1','[{"status":1,"customer_name":"BKP Grup"}]','0','0','1','')
,('00081109','Eko Nopianto S','DIVISI BISNIS KORPORASI 1','1','[{"status":1,"customer_name":"Sungai Budi Grup"}]','0','0','1','')
,('00088914','Rizkiawan Afif Handarta','DIVISI BISNIS KORPORASI 1','2','[{"status":1,"customer_name":"Bumi Indo Grup"},{"status":1,"customer_name":"Sinar Karya Mandiri"}]','0','0','2','')
,('00118906','Adi Pradipta','DIVISI BISNIS KORPORASI 1','1','[{"status":1,"customer_name":"Gudang Madu"}]','0','0','1','')
,('00125025','Dhygia Pharestyna Firmaning Ty','DIVISI BISNIS KORPORASI 1','2','[{"status":1,"customer_name":"MSAL Grup"},{"status":1,"customer_name":"Surya Alam Tunggal"}]','0','0','2','')
,('00062965','I Bagus Margono Mukti','DIVISI BISNIS KORPORASI 1','2','[{"status":1,"customer_name":"Kencana Agro"},{"status":1,"customer_name":"Musim Mas Grup"}]','0','0','2','')
,('00069202','Kholifaur Hakim','DIVISI BISNIS KORPORASI 1','1','[{"status":1,"customer_name":"Kencana Agri"}]','0','0','1','')
,('00080675','Edi Wahananto','DIVISI BISNIS KORPORASI 1','2','[{"status":1,"customer_name":"Japfa Grup"},{"status":1,"customer_name":"Sandabi Indah Lestari"}]','0','0','2','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00066723','Muhammad Tara','DIVISI BISNIS KORPORASI 3','6','[{"status":1,"customer_name":"Kaltim Kariangau Terminal"},{"status":1,"customer_name":"Pelindo II"},{"status":1,"customer_name":"Pelindo III"},{"status":1,"customer_name":"Pengembang Pelabuhan Indonesia"},{"status":1,"customer_name":"Terminal Petikemas Surabaya"},{"status":1,"customer_name":"Terminal Teluk Lamong"}]','0','0','7','')
,('00073803','Rofiq Irfani','DIVISI BISNIS KORPORASI 3','4','[{"status":1,"customer_name":"Dok Kodja Bahari"},{"status":1,"customer_name":"Pann Pembiayaan Maritim"},{"status":1,"customer_name":"Pegadaian "},{"status":1,"customer_name":"PPAF"}]','0','0','4','')
,('00073989','Ghazali Muhammad Iqbal','DIVISI BISNIS KORPORASI 3','5','[{"status":1,"customer_name":"Aerofood  Indonesia"},{"status":1,"customer_name":"Aerowisata"},{"status":1,"customer_name":"Garuda Indonesia"},{"status":1,"customer_name":"GMF"},{"status":1,"customer_name":"Perum Lppnpi \/ Airnav"}]','0','0','5','')
,('00114281','Dian Ardiansyah','DIVISI BISNIS KORPORASI 3','4','[{"status":1,"customer_name":"INTI"},{"status":1,"customer_name":"LEN"},{"status":1,"customer_name":"Pelindo I"},{"status":1,"customer_name":"Prima Multi Terminal"}]','0','0','4','')
,('00119059','Bondan Satrio Kinasih','DIVISI BISNIS KORPORASI 3','3','[{"status":1,"customer_name":"Dirgantara Indonesia"},{"status":1,"customer_name":"Permodalan Nasional Madani"},{"status":1,"customer_name":"Pindad  "}]','0','0','3','')
,('00125461','Widi Saputra Yuanda','DIVISI BISNIS KORPORASI 3','4','[{"status":1,"customer_name":"ASDP Indonesia Ferry"},{"status":1,"customer_name":"Kawasan Berikat Nusantara"},{"status":1,"customer_name":"Sucofindo"},{"status":1,"customer_name":"Surveyor"}]','0','0','4','')
,('00141025','Farhatur Roisah','DIVISI BISNIS KORPORASI 3','3','[{"status":1,"customer_name":"Telkom "},{"status":1,"customer_name":"Telkom Akses"},{"status":1,"customer_name":"Yakes Telkom"}]','0','0','3','')
,('00079099','Yolla Flesha Al Miroj Adam','DIVISI BISNIS KORPORASI 3','3','[{"status":1,"customer_name":"Geo Dipa Energi"},{"status":1,"customer_name":"Indonesia Power"},{"status":1,"customer_name":"Jasa Tirta II"}]','0','0','3','')
,('00088774','Donny Yanuardi','DIVISI BISNIS KORPORASI 3','6','[{"status":1,"customer_name":"Pembangunan Perumahan"},{"status":1,"customer_name":"Perumnas"},{"status":1,"customer_name":"Wijaya Karya  "},{"status":1,"customer_name":"Wijaya Karya  Bangunan Gedung"},{"status":1,"customer_name":"Wika Beton"},{"status":1,"customer_name":"Wika Intrade Energi"}]','0','0','6','')
,('00114254','Vander Leeuw H simbolon','DIVISI BISNIS KORPORASI 3','3','[{"status":1,"customer_name":"Angkasa Pura 1"},{"status":1,"customer_name":"Angkasa Pura 2"},{"status":1,"customer_name":"Hutama Karya"}]','0','0','3','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00119046','Isminanda Alkautsar','DIVISI BISNIS KORPORASI 3','2','[{"status":1,"customer_name":"Adhi Karya"},{"status":1,"customer_name":"Waskita Karya  "}]','0','0','2','')
,('00129454','Muh. Wahid Hasmirsyah','DIVISI BISNIS KORPORASI 3','1','[{"status":1,"customer_name":"Jasa  Marga"}]','0','0','1','')
,('00139710','Dikry Hermawan','DIVISI BISNIS KORPORASI 3','2','[{"status":1,"customer_name":"Kereta Api Indonesia  "},{"status":1,"customer_name":"Kereta Commuter Jabodetabek"}]','0','0','3','')
,('00143688','Ilmi Sekar Harumi','DIVISI BISNIS KORPORASI 3','7','[{"status":1,"customer_name":"Damri"},{"status":1,"customer_name":"Industri Kereta Api"},{"status":1,"customer_name":"Inuki"},{"status":1,"customer_name":"Kereta Api Logistik"},{"status":1,"customer_name":"Kereta Api Property Management"},{"status":1,"customer_name":"PDAM Bogor"},{"status":1,"customer_name":"PDAM Palopo"}]','0','0','7','')
,('00071970','Alex Tri Handoko Subarkah','DIVISI BISNIS KORPORASI 2','3','[{"status":1,"customer_name":"Industri Gula Glenmore"},{"status":1,"customer_name":"Perkebunan Nusantara  II"},{"status":1,"customer_name":"Perkebunan Nusantara XII"}]','0','0','3','')
,('00072808','Prawatyo Amanusa Nindito','DIVISI BISNIS KORPORASI 2','1','[{"status":1,"customer_name":"Krakatau Steel"}]','0','0','1','')
,('00088894','Teguh Prakoso','DIVISI BISNIS KORPORASI 2','0','[]','0','0','0','')
,('00125545','Ismail Ridha Hasan Pasaribu','DIVISI BISNIS KORPORASI 2','3','[{"status":1,"customer_name":"Barata Indonesia"},{"status":1,"customer_name":"Pabrik Gula Rajawali 1"},{"status":1,"customer_name":"Rajawali Nusantara"}]','0','0','3','')
,('00131902','Cynthia Dastiana','DIVISI BISNIS KORPORASI 2','1','[{"status":1,"customer_name":"Pertamina"}]','0','0','1','')
,('00052402','Arif Yuliawan','DIVISI BISNIS KORPORASI 2','0','[]','0','0','0','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00068410','Marisa Deparina','DIVISI BISNIS KORPORASI 2','0','[]','0','0','0','')
,('00069703','Nugraini Rahmaniasari','DIVISI BISNIS KORPORASI 2','1','[{"status":1,"customer_name":"Pupuk Indonesia"}]','0','0','1','')
,('00072835','Ananda Maya Margareta','DIVISI BISNIS KORPORASI 2','1','[{"status":1,"customer_name":"Bulog"}]','0','0','1','')
,('00085637','Dewanto Triaji','DIVISI BISNIS KORPORASI 2','4','[{"status":1,"customer_name":"Aneka Tambang"},{"status":1,"customer_name":"BUKIT ASAM"},{"status":1,"customer_name":"Indonesia Asahan"},{"status":1,"customer_name":"Menara Antam Sejahtera"}]','0','0','4','')
,('00138887','Dora Lisnandani','DIVISI BISNIS KORPORASI 2','4','[{"status":1,"customer_name":"Perkebunan Nusantara  VIII"},{"status":1,"customer_name":"Perkebunan Nusantara VII"},{"status":1,"customer_name":"Perkebunan Nusantara VIII"},{"status":1,"customer_name":"PG Madubaru PG Madukismo"}]','0','0','4','')
,('00141230','Rian Rahmat','DIVISI BISNIS KORPORASI 2','2','[{"status":1,"customer_name":"Bio Farma"},{"status":1,"customer_name":"Kimia Farma"}]','0','0','2','')
,('00136184','Devi Yunis','DIVISI SINDIKASI & JASA LEMBAGA KEUANGAN','0','[]','0','0','0','')
,('00069744','Thessalivia Reza','DIVISI SINDIKASI & JASA LEMBAGA KEUANGAN','4','[{"status":1,"customer_name":"INDOMOBIL FINANCE"},{"status":1,"customer_name":"JAMKRINDO           "},{"status":1,"customer_name":"KSEI"},{"status":1,"customer_name":"PT BNI Multifinance"}]','0','0','4','')
,('00077717','Rezha Pratama','DIVISI SINDIKASI & JASA LEMBAGA KEUANGAN','4','[{"status":1,"customer_name":"Asuransi Bringin Sejahtera"},{"status":1,"customer_name":"Mandiri Utama Finance"},{"status":1,"customer_name":"PT Asuransi Sinar Mas"},{"status":1,"customer_name":"PT Maybank Finance"}]','0','0','4','')
,('00134161','Ilham Halim','DIVISI SINDIKASI & JASA LEMBAGA KEUANGAN','4','[{"status":1,"customer_name":"ASKRINDO"},{"status":1,"customer_name":"Astra Sedaya Finance"},{"status":1,"customer_name":"LPEI"},{"status":1,"customer_name":"Samuel Grup"}]','0','0','5','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00062174','Shinta','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"POLISI"}]','0','0','1','')
,('00067258','Ridha Bunga  Nirmala','DIVISI INSTITUTION 1','2','[{"status":1,"customer_name":"KEMENKEU"},{"status":1,"customer_name":"PIP"}]','0','0','2','')
,('00069550','Defi Triyana','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00077594','Siti Mutiara Anugrah Husnul Kh','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00081321','Ricky Abrian Octobelly','DIVISI INSTITUTION 1','2','[{"status":1,"customer_name":"KARTIKA JAYA"},{"status":1,"customer_name":"TNI AD"}]','0','0','2','')
,('00114391','Okkie Rizqie Octora','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00125466','Zukhrufani Devi Mahisa Agni','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00143695','Ivory Mahdarina M Sitohang','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"KEMENAG"}]','0','0','1','')
,('00083126','Pristy Arnita','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"TASPEN"}]','0','0','1','')
,('00114272','Destia Eka Putri','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"BPDP SAWIT"}]','0','0','1','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00129361','Amelia Erliana Sari','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"LPS"}]','0','0','1','')
,('00134035','Hafizah','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"ESDM"}]','0','0','1','')
,('00143305','Devita Noviyanti','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00174779','Unix Rahmasaputra','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00174858','Fitria Eka Putri Eliandy','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"OJK"}]','0','0','1','')
,('00076731','Arief Sasono','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00056848','Hery Santoso','DIVISI INSTITUTION 1','6','[{"status":1,"customer_name":"ASABRI"},{"status":1,"customer_name":"BPKAD JATIM"},{"status":1,"customer_name":"BPN"},{"status":1,"customer_name":"Gereja Bethel Indonesia"},{"status":1,"customer_name":"KOMPAS GRAMEDIA"},{"status":1,"customer_name":"Kompas Group"}]','0','0','6','')
,('00062999','Ireine R.M. Rawung','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00072023','Faradita Rizky Adityarini','DIVISI INSTITUTION 1','2','[{"status":1,"customer_name":"BAPERTARUM"},{"status":1,"customer_name":"KEMENHUKUMHAM"}]','0','0','2','')
,('00073562','Aryo Cahyagunarso','DIVISI INSTITUTION 1','2','[{"status":1,"customer_name":"MABES TNI"},{"status":1,"customer_name":"TNI AU"}]','0','0','2','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00083167','Achmad Ramadhan','DIVISI INSTITUTION 1','5','[{"status":1,"customer_name":"BAWASLU"},{"status":1,"customer_name":"KEMENKES"},{"status":1,"customer_name":"KPK"},{"status":1,"customer_name":"KPU"},{"status":1,"customer_name":"PMI"}]','0','0','5','')
,('00126936','Febrina Dwi Putri','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00145764','Uky Wardhono','DIVISI INSTITUTION 1','3','[{"status":1,"customer_name":"KEMENPUPERA"},{"status":1,"customer_name":"PELNI"},{"status":1,"customer_name":"UGM"}]','0','0','3','')
,('00174861','Mohammad Faris','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00072546','Suci Triwardhani Juniar','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"LMAN"}]','0','0','1','')
,('00078140','Hindi Satya Nugraha','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00081115','Fadhil Wicaksono','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"PEMPROV DKI"}]','0','0','1','')
,('00126805','Vini Wulan Prasetyandari','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"KEMENSOS"}]','0','0','1','')
,('00130731','Anisa Fitriani','DIVISI INSTITUTION 1','2','[{"status":1,"customer_name":"BP3TI"},{"status":1,"customer_name":"KKP"}]','0','0','2','')
,('00174868','Ahmad Putra Akbar','DIVISI INSTITUTION 1','2','[{"status":1,"customer_name":"PERHUTANI"},{"status":1,"customer_name":"POLISI"}]','0','0','2','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00177461','Muhammad Aulia','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"ESDM"}]','0','0','1','')
,('00065250','Ifan Hariman','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00127356','Mohammad Endreas Akbar','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00223643','Claudia Ine Permatasari','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"TNI AL"}]','0','0','1','')
,('00071821','Andik Kurniawan','DIVISI INSTITUTION 2','5','[{"status":1,"customer_name":"Geo Dipa Energi"},{"status":1,"customer_name":"Indonesia Power"},{"status":1,"customer_name":"PJB INVESTASI"},{"status":1,"customer_name":"PLN"},{"status":1,"customer_name":"PLN - Batam"}]','0','0','5','')
,('00088917','Shella Rosalina Freshy Caressa','DIVISI INSTITUTION 2','2','[{"status":1,"customer_name":"HM SAMPOERNA"},{"status":1,"customer_name":"PHILIP MORRIS"}]','0','0','2','')
,('00125167','Pujo Adhi Susilo','DIVISI INSTITUTION 2','3','[{"status":1,"customer_name":"Bio Farma"},{"status":1,"customer_name":"KALBE FARMA"},{"status":1,"customer_name":"Kimia Farma"}]','0','0','3','')
,('00143260','Nyoman Daisy Widyanti','DIVISI INSTITUTION 2','0','[]','0','0','0','')
,('00143416','Tutut Adi Kusumadewi','DIVISI INSTITUTION 2','0','[]','0','0','0','')
,('00172074','Nursyita Pratini R','DIVISI INSTITUTION 2','6','[{"status":1,"customer_name":"Indah Kiat Pulp and Paper "},{"status":1,"customer_name":"Pabrik Kertas Tjiwi Kimia"},{"status":1,"customer_name":"Pdppm (Pindo Deli Pulp & Paper Mills)"},{"status":1,"customer_name":"SKK MIGAS"},{"status":1,"customer_name":"Smart Grup"},{"status":1,"customer_name":"Univenus "}]','0','0','6','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00085716','Maulida Wimala Nur','DIVISI INSTITUTION 2','0','[]','0','0','0','')
,('00088703','Arif Hendrayana','DIVISI INSTITUTION 2','2','[{"status":1,"customer_name":"PT UNITED TRACTORS"},{"status":1,"customer_name":"UNITED TRACTOR"}]','0','0','2','')
,('00133788','Shima Padmadewi','DIVISI INSTITUTION 2','3','[{"status":1,"customer_name":"KALTIM PRIMA COAL"},{"status":1,"customer_name":"Krakatau Steel"},{"status":1,"customer_name":"Perum Peruri "}]','0','0','3','')
,('00078150','R.P Rafi Rafsanjani','DIVISI INSTITUTION 2','1','[{"status":1,"customer_name":"FREEPORT INDONESIA"}]','0','0','1','')
,('00078256','Adityo Fernando De Arfe','DIVISI INSTITUTION 2','4','[{"status":1,"customer_name":"Alfo"},{"status":1,"customer_name":"FREEPORT INDONESIA"},{"status":1,"customer_name":"Indonesia Asahan"},{"status":1,"customer_name":"Samator Group"}]','0','0','4','')
,('00078332','Pradita Ayu Yustisia','DIVISI INSTITUTION 2','0','[]','0','0','0','')
,('00127353','Mizani Adlina Puteri','DIVISI INSTITUTION 2','0','[]','0','0','0','')
,('00143406','R. Yayu Nadya Fitria Dewi R','DIVISI INSTITUTION 2','3','[{"status":1,"customer_name":"Fajar Futura Energi"},{"status":1,"customer_name":"JAWA SATU POWER     "},{"status":1,"customer_name":"Priamanaya Energy"}]','0','0','3','')
,('00168846','Paramita Oktaviana Sakti','DIVISI INSTITUTION 2','5','[{"status":1,"customer_name":"Delta Dunia Tekstil"},{"status":1,"customer_name":"GUDANG GARAM"},{"status":1,"customer_name":"PURA GROUP"},{"status":1,"customer_name":"Sritex"},{"status":1,"customer_name":"WINGS"}]','0','0','5','')
,('00172152','Febri Rajita Usman','DIVISI INSTITUTION 2','3','[{"status":1,"customer_name":"Perkebunan Nusantara II"},{"status":1,"customer_name":"Perkebunan Nusantara X"},{"status":1,"customer_name":"Perkebunan Nusantara XI"}]','0','0','3','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00071803','Mulkan','DIVISI INSTITUTION 2','0','[]','0','0','0','')
,('00071860','Tisya Noviandinny','DIVISI INSTITUTION 2','1','[{"status":1,"customer_name":"Pupuk Indonesia"}]','0','0','1','')
,('00073642','Handika Gilang Pramana Putra','DIVISI INSTITUTION 2','1','[{"status":1,"customer_name":"Sinarmas Forestry"}]','0','0','1','')
,('00077704','Denny Maulana','DIVISI INSTITUTION 2','2','[{"status":1,"customer_name":"Pertamina Ep"},{"status":1,"customer_name":"Pertamina Hulu"}]','0','0','2','')
,('00148705','Clarissa Prahasanti Putri','DIVISI INSTITUTION 2','2','[{"status":1,"customer_name":"Angkasa Pura 1"},{"status":1,"customer_name":"Perum Lppnpi \/ Airnav"}]','0','0','2','')
,('00213959','Lulu Devita Soeryokoesoemo','DIVISI INSTITUTION 2','0','[]','0','0','0','')
,('00069108','Rio Meidiono Trisan','DIVISI INSTITUTION 2','0','[]','0','0','0','')
,('00125146','Alfian Pradana Baskoro Putra','DIVISI INSTITUTION 2','1','[{"status":1,"customer_name":"Pertamina Lubricants"}]','0','0','1','')
,('00077718','Rita Marina','DIVISI BISNIS KOMERSIAL','4','[{"status":1,"customer_name":"Gurita"},{"status":1,"customer_name":"Rimba Segara"},{"status":1,"customer_name":"Sandabi "},{"status":1,"customer_name":"Suparma Tbk"}]','0','0','4','')
,('00070659','Farisa Aprillia Tirtayasa','DIVISI BISNIS KOMERSIAL','0','[]','0','0','0','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00076582','Geby Vanessa','DIVISI BISNIS KOMERSIAL','1','[{"status":1,"customer_name":"Toba Sejahtera"}]','0','0','1','')
,('00077274','Rendra Sipahutar','DIVISI BISNIS KOMERSIAL','0','[]','0','0','0','')
,('00081326','Vebi Gustian','DIVISI BISNIS KOMERSIAL','0','[]','0','0','0','')
,('00155356','Andre Revian Danu','DIVISI BISNIS KOMERSIAL','0','[]','0','0','0','')
,('00072431','Dhani Muhammad Kurniawan','DIVISI BISNIS KOMERSIAL','3','[{"status":1,"customer_name":"Artas"},{"status":1,"customer_name":"Bosowa Group"},{"status":1,"customer_name":"Group Ssp"}]','0','0','3','')
,('00080706','Suryadi','DIVISI BISNIS KOMERSIAL','0','[]','0','0','0','')
,('00088257','Alfernado Arlis','DIVISI BISNIS KOMERSIAL','3','[{"status":1,"customer_name":"Buana Energi Surya Persada"},{"status":1,"customer_name":"Dharma Pratama Sejati"},{"status":1,"customer_name":"Fajar Futura Energi"}]','0','0','3','')
,('00057219','TITO KRISDIYANTO','DIVISI BISNIS KOMERSIAL','0','[]','0','0','0','')
,('00064746','Ari Panca Saputro','DIVISI BISNIS KOMERSIAL','0','[]','0','0','0','')
,('00071853','Nur Dini Merdeka Sari','DIVISI BISNIS KOMERSIAL','0','[]','0','0','0','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00079296','Yudhi Dharma Burnama','DIVISI BISNIS KOMERSIAL','2','[{"status":1,"customer_name":"Dinamika Indah Persada"},{"status":1,"customer_name":"Viwi"}]','0','0','2','')
,('00066801','Mochammad Ilham','DIVISI BISNIS KOMERSIAL','0','[]','0','0','0','')
,('00066873','Didik Septa Darmawan','DIVISI BISNIS KOMERSIAL','4','[{"status":1,"customer_name":"Alfo"},{"status":1,"customer_name":"Awal Bros"},{"status":1,"customer_name":"Jungleland Asia Company"},{"status":1,"customer_name":"Matahari Sentosa Jaya"}]','0','0','4','')
,('00069694','Yaniz Wahyu Astari','DIVISI BISNIS KOMERSIAL','3','[{"status":1,"customer_name":"Delta Dunia Tekstil"},{"status":1,"customer_name":"Molindo"},{"status":1,"customer_name":"Pelangi Indah Canindo"}]','0','0','3','')
,('00071957','Tomy Cahyo Nugroho','DIVISI BISNIS KOMERSIAL','4','[{"status":1,"customer_name":"Bakrie Metal Industries"},{"status":1,"customer_name":"Bakrie Pipe Industries"},{"status":1,"customer_name":"Karya Tugas Anda"},{"status":1,"customer_name":"Sritex"}]','0','0','4','')
,('00072707','Firman Fajar Octavian','DIVISI BISNIS KOMERSIAL','2','[{"status":1,"customer_name":"Cemindo Group"},{"status":1,"customer_name":"Medco Group"}]','0','0','2','')
,('00066768','Yaser Atmayudha Negara','DIVISI BISNIS KOMERSIAL','4','[{"status":1,"customer_name":"Indah Kiat Pulp and Paper "},{"status":1,"customer_name":"Pabrik Kertas Tjiwi Kimia"},{"status":1,"customer_name":"Sinar Mas Group"},{"status":1,"customer_name":"Univenus "}]','0','0','4','')
,('00078143','Irwansyah Setiadi','DIVISI BISNIS KOMERSIAL','2','[{"status":1,"customer_name":"Fajar Surya Wisesa"},{"status":1,"customer_name":"Mutiara Ferindo Internusa"}]','0','0','2','')
,('00127398','Sevi Puri WIjaya','DIVISI BISNIS KOMERSIAL','2','[{"status":1,"customer_name":"Global Jaya Maritim"},{"status":1,"customer_name":"Pdppm (Pindo Deli Pulp & Paper Mills)"}]','0','0','2','')
,('00132082','Yudhistira Adi Nugraha Paturus','DIVISI BISNIS KOMERSIAL','2','[{"status":1,"customer_name":"Citra Waspphutowa"},{"status":1,"customer_name":"Medan Smart Jaya"}]','0','0','2','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00134180','Maya Kartika Eismaputeri','DIVISI BISNIS KOMERSIAL','1','[{"status":1,"customer_name":"Jembatan Nusantara"}]','0','0','1','')
,('00162529','Friska Tri Febryanti','DIVISI BISNIS KORPORASI 3','2','[{"status":1,"customer_name":"PLN"},{"status":1,"customer_name":"PLN - Batam"}]','0','0','2','')
,('00129434','Fadil Mujib','DIVISI BISNIS KORPORASI 1','2','[{"status":1,"customer_name":"AKFI Grup"},{"status":1,"customer_name":"Alam Grup"}]','0','0','2','')
,('00083105','Doni Andriyali Armarieno','DIVISI BISNIS KORPORASI 1','0','[]','0','0','0','')
,('00059981','Rizky Ramdhani','DIVISI BISNIS KORPORASI 1','2','[{"status":1,"customer_name":"Samuel Grup"},{"status":1,"customer_name":"Tanjung Unggul Mandiri"}]','0','0','2','')
,('00143411','Rizky Febrianto Putra Negara','DIVISI BISNIS KORPORASI 1','1','[{"status":1,"customer_name":"Senabungan Aneka Pertiwi"}]','0','0','1','')
,('00168852','Reny Marissa Panggabean','DIVISI INSTITUTION 2','0','[]','0','0','0','')
,('00069301','Selvie Eurodani','DIVISI INSTITUTION 2','0','[]','0','0','0','')
,('00114404','Revi Lonna','DIVISI INSTITUTION 2','4','[{"status":1,"customer_name":"Adaro Indonesia"},{"status":1,"customer_name":"Aneka Tambang"},{"status":1,"customer_name":"BUKIT ASAM"},{"status":1,"customer_name":"Menara Antam Sejahtera"}]','0','0','4','')
,('00080648','Mohammad Reza','DIVISI INSTITUTION 2','0','[]','0','0','0','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00072573','Raden Beril Trianov','DIVISI INSTITUTION 2','0','[]','0','0','0','')
,('00136154','Mohammad Fuad Zulkarnain','DIVISI INSTITUTION 2','4','[{"status":1,"customer_name":"Semen Baturaja"},{"status":1,"customer_name":"Semen Indonesia"},{"status":1,"customer_name":"Semen Padang"},{"status":1,"customer_name":"Semen Tonasa"}]','0','0','4','')
,('00077517','Ahmad Andreyno','DIVISI INSTITUTION 2','6','[{"status":1,"customer_name":"Asam Jawa Grup"},{"status":1,"customer_name":"ASTRA AGRO LESTARI"},{"status":1,"customer_name":"Gudang Madu"},{"status":1,"customer_name":"Musim Mas Grup"},{"status":1,"customer_name":"Permata Hijau Grup"},{"status":1,"customer_name":"Royal Golden Eagle"}]','0','0','6','')
,('00174764','Karina Diandra Supardan','DIVISI INSTITUTION 1','2','[{"status":1,"customer_name":"KEMERISTEKDIKTI"},{"status":1,"customer_name":"UNIVERSITAS TERBUKA"}]','0','0','2','')
,('00175000','Harris Angelo H Batubara','DIVISI INSTITUTION 1','2','[{"status":1,"customer_name":"KEMENPERINDUSTRIAN"},{"status":1,"customer_name":"KEMNAKER"}]','0','0','2','')
,('00162502','Dara Okti Sari','DIVISI INSTITUTION 1','2','[{"status":1,"customer_name":"KEMENKOP"},{"status":1,"customer_name":"LPDB"}]','0','0','2','')
,('00148688','Ayuditya Widha Kurnia Sari','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00172058','Aresti Dilla Ramadani','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"BNPB"}]','0','0','1','')
,('00219373','Borin Jeremia Amadeus Siahaan','DIVISI INSTITUTION 1','0','[]','0','0','0','')
,('00140770','Andrie Wiratama','DIVISI INSTITUTION 1','1','[{"status":1,"customer_name":"Batan Teknologi"}]','0','0','1','')
;
INSERT INTO [dashboard-bri].dbo.rmmonitoring (personal_number,rm_name,division,account_planning_total,account_planning_list,account_planning_publish,account_planning_wa,account_planning_draft,account_planning_progress) VALUES 
('00068434','Dhanny','DIVISI SINDIKASI & JASA LEMBAGA KEUANGAN','3','[{"status":1,"customer_name":"KPEI"},{"status":1,"customer_name":"SARANA MULTIGRIYA FINANCE"},{"status":1,"customer_name":"TOYOTA ASTRA FINANCE"}]','0','0','3','')
,('00069619','Seno Hadi Broto','DIVISI BISNIS KOMERSIAL','3','[{"status":1,"customer_name":"Adaro Indonesia"},{"status":1,"customer_name":"KALTIM PRIMA COAL"},{"status":1,"customer_name":"Tangki Merak"}]','0','0','3','')
,('00069706','Hasan Zainul Uluum','DIVISI BISNIS KORPORASI 1','1','[{"status":1,"customer_name":"FKS Grup"}]','0','0','1','')
,('00134018','Dicky Pradhana Wahyudinansyah','DIVISI BISNIS KORPORASI 2','1','[{"status":1,"customer_name":"Perusahaan Gas Negara"}]','0','0','1','')
,('00067656','Aditya Lingga Pramana','DIVISI BISNIS KORPORASI 2','2','[{"status":1,"customer_name":"Dok Dan Perkapalan Surabaya"},{"status":1,"customer_name":"Pertani"}]','0','0','2','')
,('00238276','Bagaskara Ikhlasulla Arif','DIVISI BISNIS KORPORASI 2','0','[]','0','0','0','')
,('00172640','Surya Adhadiyat','DIVISI BISNIS KORPORASI 2','3','[{"status":1,"customer_name":"Perkebunan Nusantara  XI"},{"status":1,"customer_name":"Perkebunan Nusantara I"},{"status":1,"customer_name":"Perkebunan Nusantara IX"}]','0','0','3','')
,('00172392','Rachmat Prio Wibowo','DIVISI BISNIS KORPORASI 2','0','[]','0','0','0','')
,('00143864','Randhiyatmoko','DIVISI INSTITUTION 2','9','[{"status":1,"customer_name":"Adhi Karya"},{"status":1,"customer_name":"Telekomunikasi Indonesia Internasional"},{"status":1,"customer_name":"Telkom "},{"status":1,"customer_name":"Telkom Akses"},{"status":1,"customer_name":"Telkomsel"},{"status":1,"customer_name":"Waskita Karya  "},{"status":1,"customer_name":"Wijaya Karya  "},{"status":1,"customer_name":"Wika Beton"},{"status":1,"customer_name":"Wika Intrade Energi"}]','0','0','9','')
;