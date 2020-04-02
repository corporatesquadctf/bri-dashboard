-- Drop table

DROP TABLE CPA_KORPORASI_DEV.dbo.Summary_CpaCif GO

CREATE TABLE CPA_KORPORASI_DEV.dbo.Summary_CpaCif (
	Cif varchar(10) ,
	Periode datetime NULL,
	BebanFtp numeric(18,3) NULL,
	Provisi numeric(18,3) NULL,
	PlafonEfektif numeric(28,3) NULL,
	PlafonAwal numeric(28,3) NULL,
	KelonggaranTarik numeric(28,3) NULL,
	BakiDebetOriginal numeric(18,3) NULL,
	BakiDebet numeric(18,3) NULL,
	BakiDebetRatas numeric(18,3) NULL,
	Ppap int NULL,
	BiayaPpapAkumulasi numeric(18,3) NULL,
	PpapRatas int NULL,
	NilaiTercatat numeric(18,3) NULL,
	NilaiTercatatRatas numeric(18,3) NULL,
	Ckpn numeric(18,3) NULL,
	PendapatanBunga numeric(18,3) NULL,
	PendapatanBungaAkumulasi numeric(18,3) NULL,
	JumlahRekKredit int NULL,
	NominalFeeKredit numeric(18,3) NULL,
	NominalTrxKredit numeric(18,3) NULL,
	TotalTrx int NULL,
	AkumulasiNominalTrx numeric(18,3) NULL,
	AkumulasiNominalFee numeric(18,3) NULL,
	AkumulasiJumlahTrx int NULL,
	AkumulasiJumlahTrxKredit int NULL,
	ProvisiAkumulasiKredit numeric(18,3) NULL,
	SaldoSimpanan numeric(18,3) NULL,
	AverageSaldoSimpanan numeric(18,3) NULL,
	JumlahRekSimpanan int NULL,
	NominalFeeSimpanan numeric(18,3) NULL,
	NominatTrxSimpanan numeric(18,3) NULL,
	TotalTrxSimpanan int NULL,
	AkumulasiNominalTrxSimpanan numeric(18,3) NULL,
	AkumulasiNominalFeeSimpanan numeric(18,3) NULL,
	AkumulasiJumlahTrxSimpanan int NULL,
	BebanFtpAkumulasi numeric(18,3) NULL,
	BebanBunga numeric(18,3) NULL,
	BebanBungaAkumulasi numeric(18,3) NULL,
	PendapatanFtp numeric(18,3) NULL,
	PendapatanFtpAkumulasi numeric(18,3) NULL,
	AmountIdrTf numeric(18,3) NULL,
	NominalFeeTf numeric(18,3) NULL,
	NominalTrxTf numeric(18,3) NULL,
	TotalTrxTf int NULL,
	AkumulasiNominalTrxTf numeric(18,3) NULL,
	AkumulasiNominalFeeTf numeric(18,3) NULL,
	AkumulasiJumlahTrxTf int NULL,
	JumlahTf int NULL,
	Nilai numeric(18,3) NULL,
	NilaiFtp numeric(18,3) NULL,
	FeeBased numeric(18,3) NULL,
	TotalBiayaOperasional numeric(18,3) NULL,
	BiayaPpap numeric(18,3) NULL,
	BiayaModal numeric(18,3) NULL,
	LabaRugiSebelumModal numeric(18,3) NULL,
	LabaRugiSetelahModal numeric(18,3) NULL,
	LabaRugiFtpSeblumModal numeric(18,3) NULL,
	LabaRugiFtpSetelahModal numeric(18,3) NULL
) GO
 CREATE NONCLUSTERED INDEX ix_Summ_CpaCif ON dbo.Summary_CpaCif (  Cif ASC  , Periode ASC  )  
	 WITH (  PAD_INDEX = OFF ,FILLFACTOR = 100  ,SORT_IN_TEMPDB = OFF , IGNORE_DUP_KEY = OFF , STATISTICS_NORECOMPUTE = OFF , ONLINE = OFF , ALLOW_ROW_LOCKS = ON , ALLOW_PAGE_LOCKS = ON  )
	 ON [PRIMARY ]  GO

-- Drop table

DROP TABLE CPA_KORPORASI_DEV.dbo.Summary_PinjamanDailyCif GO

CREATE TABLE CPA_KORPORASI_DEV.dbo.Summary_PinjamanDailyCif (
	Cif varchar(10) ,
	Periode datetime NULL,
	Currency char(3) ,
	PlafonAwal numeric(18,3) NULL,
	PlafonEfektif numeric(18,3) NULL,
	KelonggaranTarik numeric(18,3) NULL,
	BakiDebetOriginal numeric(18,3) NULL,
	BakiDebet numeric(18,3) NULL,
	Ppap int NULL,
	NilaiTercatat numeric(18,3) NULL,
	NilaiTercatatRatas numeric(18,3) NULL,
	Ckpn numeric(18,3) NULL,
	Provisi numeric(18,3) NULL,
	ProvisiAkumulasi numeric(18,3) NULL
) GO
 CREATE NONCLUSTERED INDEX ix_Summ_PinjamanDailyCif ON dbo.Summary_PinjamanDailyCif (  Cif ASC  , Periode ASC  , Currency ASC  )  
	 WITH (  PAD_INDEX = OFF ,FILLFACTOR = 100  ,SORT_IN_TEMPDB = OFF , IGNORE_DUP_KEY = OFF , STATISTICS_NORECOMPUTE = OFF , ONLINE = OFF , ALLOW_ROW_LOCKS = ON , ALLOW_PAGE_LOCKS = ON  )
	 ON [PRIMARY ]  GO

-- Drop table

DROP TABLE CPA_KORPORASI_DEV.dbo.Summary_PinjamanMonthlyCif GO

CREATE TABLE CPA_KORPORASI_DEV.dbo.Summary_PinjamanMonthlyCif (
	Cif varchar(10) ,
	Periode datetime NULL,
	Currency char(3) ,
	PlafonAwal numeric(18,3) NULL,
	PlafonEfektif numeric(18,3) NULL,
	KelonggaranTarik numeric(18,3) NULL,
	BakiDebetOriginal numeric(18,3) NULL,
	BakiDebet numeric(18,3) NULL,
	BakiDebetRatas numeric(18,3) NULL,
	Ppap int NULL,
	BiayaPpap numeric(18,3) NULL,
	BiayaPpapAkumulasi numeric(18,3) NULL,
	PpapRatas int NULL,
	NilaiTercatat numeric(18,3) NULL,
	NilaiTercatatRatas numeric(18,3) NULL,
	Ckpn numeric(18,3) NULL,
	PendapatanBunga numeric(18,3) NULL,
	PendapatanBungaAkumulasi numeric(18,3) NULL,
	PendapatanFtp numeric(18,3) NULL,
	PendapatanFtpAkumulasi numeric(18,3) NULL,
	Provisi numeric(18,3) NULL,
	ProvisiAkumulasi numeric(18,3) NULL
) GO
 CREATE NONCLUSTERED INDEX ix_Summ_PinjamanMonthlyCif ON dbo.Summary_PinjamanMonthlyCif (  Cif ASC  , Periode ASC  , Currency ASC  )  
	 WITH (  PAD_INDEX = OFF ,FILLFACTOR = 100  ,SORT_IN_TEMPDB = OFF , IGNORE_DUP_KEY = OFF , STATISTICS_NORECOMPUTE = OFF , ONLINE = OFF , ALLOW_ROW_LOCKS = ON , ALLOW_PAGE_LOCKS = ON  )
	 ON [PRIMARY ]  GO

-- Drop table

DROP TABLE CPA_KORPORASI_DEV.dbo.Summary_SimpananDailyCif GO

CREATE TABLE CPA_KORPORASI_DEV.dbo.Summary_SimpananDailyCif (
	Cif varchar(10) ,
	Periode datetime NULL,
	Currency char(3) ,
	Saldo numeric(18,3) NULL,
	AverageSaldo numeric(18,3) NULL
) GO
 CREATE NONCLUSTERED INDEX ix_Summ_SimpananDailyCif ON dbo.Summary_SimpananDailyCif (  Cif ASC  , Periode ASC  , Currency ASC  )  
	 WITH (  PAD_INDEX = OFF ,FILLFACTOR = 100  ,SORT_IN_TEMPDB = OFF , IGNORE_DUP_KEY = OFF , STATISTICS_NORECOMPUTE = OFF , ONLINE = OFF , ALLOW_ROW_LOCKS = ON , ALLOW_PAGE_LOCKS = ON  )
	 ON [PRIMARY ]  GO

-- Drop table

DROP TABLE CPA_KORPORASI_DEV.dbo.Summary_SimpananMonthlyCif GO

CREATE TABLE CPA_KORPORASI_DEV.dbo.Summary_SimpananMonthlyCif (
	Cif varchar(10) ,
	Periode datetime NULL,
	Currency char(3) ,
	Saldo numeric(18,3) NULL,
	AverageSaldo numeric(18,3) NULL,
	BebanBunga numeric(18,3) NULL,
	BebanBungaAkumulasi numeric(18,3) NULL,
	BebanBungaFtp numeric(18,3) NULL,
	BebanBungaFtpAkumulasi numeric(18,3) NULL
) GO
 CREATE NONCLUSTERED INDEX ix_Summ_SimpananMonthlyCif ON dbo.Summary_SimpananMonthlyCif (  Cif ASC  , Periode ASC  , Currency ASC  )  
	 WITH (  PAD_INDEX = OFF ,FILLFACTOR = 100  ,SORT_IN_TEMPDB = OFF , IGNORE_DUP_KEY = OFF , STATISTICS_NORECOMPUTE = OFF , ONLINE = OFF , ALLOW_ROW_LOCKS = ON , ALLOW_PAGE_LOCKS = ON  )
	 ON [PRIMARY ]  GO