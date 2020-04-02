Use [BRIDashboard];

GO

-------------------------
/* Summary FACT TABLES */

CREATE TABLE Summary_SimpananMonthlyCif(
	Cif VARCHAR(10),
	Periode DATETIME,
	Currency CHAR(3),
	Status INT,
	RateSimpanan NUMERIC(5,2),
	RateFtp NUMERIC(5,2),
	Saldo NUMERIC(28,3),
	AverageSaldo NUMERIC(28,3),
	BebanBunga NUMERIC(28,3),
	BebanBungaAkumulasi NUMERIC(28,3),
	BebanBungaFtp NUMERIC(28,3),
	BebanBungaFtpAkumulasi NUMERIC(28,3)
);
CREATE INDEX ix_Summ_SimpananMonthlyCif ON Summary_SimpananMonthlyCif(Cif, Periode, Currency, Status);

CREATE TABLE Summary_SimpananDailyCif(
	Cif VARCHAR(10),
	Periode DATETIME,
	Currency CHAR(3),
	Status INT,
	RateSimpanan NUMERIC(5,2),
	RateFtp NUMERIC(5,2),
	Saldo NUMERIC(28,3),
	AverageSaldo NUMERIC(28,3)
);
CREATE INDEX ix_Summ_SimpananDailyCif ON Summary_SimpananDailyCif(Cif, Periode, Currency, Status);

CREATE TABLE Summary_PinjamanMonthlyCif(
	Cif VARCHAR(10),
	Periode DATETIME,
	Currency CHAR(3),
	JenisPenggunaan INT,
	PlafonAwal NUMERIC(28,3),
	PlafonEfektif NUMERIC(28,3),
	KelonggaranTarik NUMERIC(28,3),
	Kolektibilitas INT,
	BakiDebetOriginal NUMERIC(28,3),
	BakiDebet NUMERIC(28,3),
	BakiDebetRatas NUMERIC(28,3),
	RatePinjaman NUMERIC(5,2),
	Ppap INT,
	BiayaPpap NUMERIC(28,3),
	BiayaPpapAkumulasi NUMERIC(28,3),
	PpapRatas INT,
	NilaiTercatat NUMERIC(28,3),
	NilaiTercatatRatas NUMERIC(28,3),
	Ckpn NUMERIC(28,3),
	PendapatanBunga NUMERIC(28,3),
	PendapatanBungaAkumulasi NUMERIC(28,3),
	PendapatanFtp NUMERIC(28,3),
	PendapatanFtpAkumulasi NUMERIC(28,3),
	Provisi NUMERIC(28,3),
	ProvisiAkumulasi NUMERIC(28,3)
);
CREATE INDEX ix_Summ_PinjamanMonthlyCif ON Summary_PinjamanMonthlyCif(Cif, Periode, Currency, JenisPenggunaan);

CREATE TABLE Summary_PinjamanDailyCif(
	Cif VARCHAR(10),
	Periode DATETIME,
	Currency CHAR(3),
	JenisPenggunaan INT,
	PlafonAwal NUMERIC(28,3),
	PlafonEfektif NUMERIC(28,3),
	KelonggaranTarik NUMERIC(28,3),
	Kolektibilitas INT,
	BakiDebetOriginal NUMERIC(28,3),
	BakiDebet NUMERIC(28,3),
	RatePinjaman NUMERIC(5,2),
	Ppap INT,
	NilaiTercatat NUMERIC(28,3),
	NilaiTercatatRatas NUMERIC(28,3),
	Ckpn NUMERIC(28,3),
	Provisi NUMERIC(28,3),
	ProvisiAkumulasi NUMERIC(28,3)
);
CREATE INDEX ix_Summ_PinjamanDailyCif ON Summary_PinjamanDailyCif(Cif, Periode, Currency, JenisPenggunaan);

CREATE TABLE Summary_CpaCif(
	Cif VARCHAR(10),
	Periode DATETIME,
	BebanFtp NUMERIC(28,3),
	Provisi NUMERIC(28,3),
	PlafonEfektif NUMERIC(28,3),
	PlafonAwal NUMERIC(28,3),
	KelonggaranTarik NUMERIC(28,3),
	BakiDebetOriginal NUMERIC(28,3),
	BakiDebet NUMERIC(28,3),
	BakiDebetRatas NUMERIC(28,3),
	Ppap INT,
	BiayaPpapAkumulasi NUMERIC(28,3),
	PpapRatas INT,
	NilaiTercatat NUMERIC(28,3),
	NilaiTercatatRatas NUMERIC(28,3),
	Ckpn NUMERIC(28,3),
	PendapatanBunga NUMERIC(28,3),
	PendapatanBungaAkumulasi NUMERIC(28,3),
	JumlahRekKredit INT,
	NominalFeeKredit NUMERIC(28,3),
	NominalTrxKredit NUMERIC(28,3),
	TotalTrx INT,
	AkumulasiNominalTrx NUMERIC(28,3),
	AkumulasiNominalFee NUMERIC(28,3),
	AkumulasiJumlahTrx INT,
	AkumulasiJumlahTrxKredit INT,
	ProvisiAkumulasiKredit NUMERIC(28,3),
	SaldoSimpanan NUMERIC(28,3),
	AverageSaldoSimpanan NUMERIC(28,3),
	JumlahRekSimpanan INT,
	NominalFeeSimpanan NUMERIC(28,3),
	NominatTrxSimpanan NUMERIC(28,3),
	TotalTrxSimpanan INT,
	AkumulasiNominalTrxSimpanan NUMERIC(28,3),
	AkumulasiNominalFeeSimpanan NUMERIC(28,3),
	AkumulasiJumlahTrxSimpanan INT,
	BebanFtpAkumulasi NUMERIC(28,3),
	BebanBunga NUMERIC(28,3),
	BebanBungaAkumulasi NUMERIC(28,3),
	PendapatanFtp NUMERIC(28,3),
	PendapatanFtpAkumulasi NUMERIC(28,3),
	AmountIdrTf NUMERIC(28,3),
	NominalFeeTf NUMERIC(28,3),
	NominalTrxTf NUMERIC(28,3),
	TotalTrxTf INT,
	AkumulasiNominalTrxTf NUMERIC(28,3),
	AkumulasiNominalFeeTf NUMERIC(28,3),
	AkumulasiJumlahTrxTf INT,
	JumlahTf INT,
	Nilai NUMERIC(28,3),
	NilaiFtp NUMERIC(28,3),
	FeeBased NUMERIC(28,3),
	TotalBiayaOperasional NUMERIC(28,3),
	BiayaPpap NUMERIC(28,3),
	BiayaModal NUMERIC(28,3),
	LabaRugiSebelumModal NUMERIC(28,3),
	LabaRugiSetelahModal NUMERIC(28,3),
	LabaRugiFtpSeblumModal NUMERIC(28,3),
	LabaRugiFtpSetelahModal NUMERIC(28,3)
);
CREATE INDEX ix_Summ_CpaCif ON Summary_CpaCif(Cif, Periode);


CREATE TABLE Summary_SimpananMonthlyCustomer(
	Vcif VARCHAR(10),
	Periode DATETIME,
	Currency CHAR(3),
	Status INT,
	RateSimpanan NUMERIC(5,2),
	RateFtp NUMERIC(5,2),
	Saldo NUMERIC(28,3),
	AverageSaldo NUMERIC(28,3),
	BebanBunga NUMERIC(28,3),
	BebanBungaAkumulasi NUMERIC(28,3),
	BebanBungaFtp NUMERIC(28,3),
	BebanBungaFtpAkumulasi NUMERIC(28,3)
);
CREATE INDEX ix_Summ_SimpananMonthlyCustomer ON Summary_SimpananMonthlyCustomer(Vcif, Periode, Currency, Status);

CREATE TABLE Summary_SimpananDailyCustomer(
	Vcif VARCHAR(10),
	Periode DATETIME,
	Currency CHAR(3),
	Status INT,
	RateSimpanan NUMERIC(5,2),
	RateFtp NUMERIC(5,2),
	Saldo NUMERIC(28,3),
	AverageSaldo NUMERIC(28,3)
);
CREATE INDEX ix_Summ_SimpananDailyCustomer ON Summary_SimpananDailyCustomer(Vcif, Periode, Currency, Status);

CREATE TABLE Summary_PinjamanMonthlyCustomer(
	Vcif VARCHAR(10),
	Periode DATETIME,
	Currency CHAR(3),
	JenisPenggunaan INT,
	PlafonAwal NUMERIC(28,3),
	PlafonEfektif NUMERIC(28,3),
	KelonggaranTarik NUMERIC(28,3),
	Kolektibilitas INT,
	BakiDebetOriginal NUMERIC(28,3),
	BakiDebet NUMERIC(28,3),
	BakiDebetRatas NUMERIC(28,3),
	RatePinjaman NUMERIC(5,2),
	Ppap INT,
	BiayaPpap NUMERIC(28,3),
	BiayaPpapAkumulasi NUMERIC(28,3),
	PpapRatas INT,
	NilaiTercatat NUMERIC(28,3),
	NilaiTercatatRatas NUMERIC(28,3),
	Ckpn NUMERIC(28,3),
	PendapatanBunga NUMERIC(28,3),
	PendapatanBungaAkumulasi NUMERIC(28,3),
	PendapatanFtp NUMERIC(28,3),
	PendapatanFtpAkumulasi NUMERIC(28,3),
	Provisi NUMERIC(28,3),
	ProvisiAkumulasi NUMERIC(28,3)
);
CREATE INDEX ix_Summ_PinjamanMonthlyCustomer ON Summary_PinjamanMonthlyCustomer(Vcif, Periode, Currency, JenisPenggunaan);

CREATE TABLE Summary_PinjamanDailyCustomer(
	Vcif VARCHAR(10),
	Periode DATETIME,
	Currency CHAR(3),
	JenisPenggunaan INT,
	PlafonAwal NUMERIC(28,3),
	PlafonEfektif NUMERIC(28,3),
	KelonggaranTarik NUMERIC(28,3),
	Kolektibilitas INT,
	BakiDebetOriginal NUMERIC(28,3),
	BakiDebet NUMERIC(28,3),
	RatePinjaman NUMERIC(5,2),
	Ppap INT,
	NilaiTercatat NUMERIC(28,3),
	NilaiTercatatRatas NUMERIC(28,3),
	Ckpn NUMERIC(28,3),
	Provisi NUMERIC(28,3),
	ProvisiAkumulasi NUMERIC(28,3)
);
CREATE INDEX ix_Summ_PinjamanDailyCustomer ON Summary_PinjamanDailyCustomer(Vcif, Periode, Currency, JenisPenggunaan);

CREATE TABLE Summary_CpaCustomer(
	Vcif VARCHAR(10),
	Periode DATETIME,
	BebanFtp NUMERIC(28,3),
	Provisi NUMERIC(28,3),
	PlafonEfektif NUMERIC(28,3),
	PlafonAwal NUMERIC(28,3),
	KelonggaranTarik NUMERIC(28,3),
	BakiDebetOriginal NUMERIC(28,3),
	BakiDebet NUMERIC(28,3),
	BakiDebetRatas NUMERIC(28,3),
	Ppap INT,
	BiayaPpapAkumulasi NUMERIC(28,3),
	PpapRatas INT,
	NilaiTercatat NUMERIC(28,3),
	NilaiTercatatRatas NUMERIC(28,3),
	Ckpn NUMERIC(28,3),
	PendapatanBunga NUMERIC(28,3),
	PendapatanBungaAkumulasi NUMERIC(28,3),
	JumlahRekKredit INT,
	NominalFeeKredit NUMERIC(28,3),
	NominalTrxKredit NUMERIC(28,3),
	TotalTrx INT,
	AkumulasiNominalTrx NUMERIC(28,3),
	AkumulasiNominalFee NUMERIC(28,3),
	AkumulasiJumlahTrx INT,
	AkumulasiJumlahTrxKredit INT,
	ProvisiAkumulasiKredit NUMERIC(28,3),
	SaldoSimpanan NUMERIC(28,3),
	AverageSaldoSimpanan NUMERIC(28,3),
	JumlahRekSimpanan INT,
	NominalFeeSimpanan NUMERIC(28,3),
	NominatTrxSimpanan NUMERIC(28,3),
	TotalTrxSimpanan INT,
	AkumulasiNominalTrxSimpanan NUMERIC(28,3),
	AkumulasiNominalFeeSimpanan NUMERIC(28,3),
	AkumulasiJumlahTrxSimpanan INT,
	BebanFtpAkumulasi NUMERIC(28,3),
	BebanBunga NUMERIC(28,3),
	BebanBungaAkumulasi NUMERIC(28,3),
	PendapatanFtp NUMERIC(28,3),
	PendapatanFtpAkumulasi NUMERIC(28,3),
	AmountIdrTf NUMERIC(28,3),
	NominalFeeTf NUMERIC(28,3),
	NominalTrxTf NUMERIC(28,3),
	TotalTrxTf INT,
	AkumulasiNominalTrxTf NUMERIC(28,3),
	AkumulasiNominalFeeTf NUMERIC(28,3),
	AkumulasiJumlahTrxTf INT,
	JumlahTf INT,
	Nilai NUMERIC(28,3),
	NilaiFtp NUMERIC(28,3),
	FeeBased NUMERIC(28,3),
	TotalBiayaOperasional NUMERIC(28,3),
	BiayaPpap NUMERIC(28,3),
	BiayaModal NUMERIC(28,3),
	LabaRugiSebelumModal NUMERIC(28,3),
	LabaRugiSetelahModal NUMERIC(28,3),
	LabaRugiFtpSeblumModal NUMERIC(28,3),
	LabaRugiFtpSetelahModal NUMERIC(28,3)
);
CREATE INDEX ix_Summ_CpaCustomer ON Summary_CpaCustomer(Vcif, Periode);