
CREATE TABLE gender(
	id_gender char(1),
	nama varchar(12),
	PRIMARY KEY (id_gender)
    
);

CREATE TABLE permission(
	id_permission char(5),
   	readfile boolean,
   	writefile boolean,
    PRIMARY KEY (id_permission)
);

CREATE TABLE jabatan(
	id_jabatan char(5),
   	nama varchar(100),
    PRIMARY KEY (id_jabatan)
);

CREATE TABLE jenis_arsip(
	id_jenisarsip char(5),
	nama VARCHAR (100),
	PRIMARY KEY (id_jenisarsip)
);

CREATE TABLE kode(
	id_kode char(6),
	nama VARCHAR(200),
	PRIMARY KEY (id_kode)
);

CREATE TABLE klasifikasi(
	id_klasifikasi char(10),
	id_kode char(6),
	id_jabatan char(5),
	id_permission char(5),
	PRIMARY KEY (id_permissionarsip),
	FOREIGN KEY (id_kode) REFERENCES kode(id_kode),
	FOREIGN KEY (id_jabatan) REFERENCES jabatan(id_jabatan),
	FOREIGN KEY (id_permission) REFERENCES permission(id_permission)
);

CREATE TABLE datapengguna(
	id_datapengguna char(10),
	nip char(18),
	nama varchar(255),
	tgl_lahir date,
	foto_profil varchar(100),
	create_time timestamp,
	update_time timestamp,
	id_gender char(1),
	id_jabatan char(5),
	PRIMARY KEY (id_datapengguna),
    FOREIGN KEY (id_jabatan) REFERENCES jabatan(id_jabatan),
    FOREIGN KEY (id_gender) REFERENCES gender(id_gender)
);

CREATE TABLE berkas(
	id_berkas char(20),
	nama varchar(255),
	parent_berkas char(20),
	id_upload char(10),
	byte_total varchar(10),
	create_time timestamp,
	update_time timestamp,
	PRIMARY KEY (id_berkas),
	FOREIGN KEY (id_upload) REFERENCES datapengguna(id_datapengguna)
);
/*Lampiran atau Surat*/
CREATE TABLE dokumen(
	id_dokumen char(20),
	nama varchar(255),
	no_surat varchar(30),
	hal varchar(100),
	ekstensi varchar(5),
	byte_file varchar(10),
	type_file VARCHAR(10),
	create_time timestamp,
	update_time timestamp,
	id_upload char(8),
	PRIMARY KEY (id_dokumen),
	FOREIGN KEY (id_upload) REFERENCES datapengguna(id_datapengguna)
);

CREATE TABLE filemanager(
	id_filemanager char(20),
	id_dokumen char(20),
	id_berkas char(20),
	PRIMARY KEY (id_filemanager),
	FOREIGN KEY (id_dokumen) REFERENCES dokumen(id_dokumen),
	FOREIGN KEY (id_berkas) REFERENCES berkas(id_berkas)
);


