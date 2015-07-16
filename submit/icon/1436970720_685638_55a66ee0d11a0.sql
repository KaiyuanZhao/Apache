prompt PL/SQL Developer import file
prompt Created on 2015年7月14日 by dell1
set feedback off
set define off
prompt Creating APPLY$_DEST_OBJ_CMAP...
create table APPLY$_DEST_OBJ_CMAP
(
  dest_id         NUMBER not null,
  src_long_cname  VARCHAR2(4000) not null,
  dest_long_cname VARCHAR2(4000),
  spare1          NUMBER
)
;
create index I_APPLY_DEST_OBJ_CMAP1 on APPLY$_DEST_OBJ_CMAP (DEST_ID);

prompt Creating EMPLOYEE...
create table EMPLOYEE
(
  employee_id      NUMBER not null,
  employee_name    VARCHAR2(10) not null,
  gender           VARCHAR2(4) not null,
  credit           VARCHAR2(45) not null,
  phone_number     VARCHAR2(45) not null,
  salary           NUMBER not null,
  image            VARCHAR2(45) not null,
  lenth_of_service NUMBER not null
)
;
comment on column EMPLOYEE.employee_id
  is '员工工号';
comment on column EMPLOYEE.employee_name
  is '员工姓名';
comment on column EMPLOYEE.gender
  is '性别';
comment on column EMPLOYEE.credit
  is '身份证号';
comment on column EMPLOYEE.phone_number
  is '手机号码';
comment on column EMPLOYEE.salary
  is '基本工资';
comment on column EMPLOYEE.image
  is '照片';
comment on column EMPLOYEE.lenth_of_service
  is '工龄';
alter table EMPLOYEE
  add constraint EMPLOYEE_ID primary key (EMPLOYEE_ID);

prompt Creating DOCDOR...
create table DOCDOR
(
  employee_id NUMBER not null,
  level_      VARCHAR2(45) not null,
  section_id  NUMBER not null,
  password    VARCHAR2(45) not null,
  description VARCHAR2(400)
)
;
comment on column DOCDOR.employee_id
  is '工号，外键';
comment on column DOCDOR.level_
  is '职称';
comment on column DOCDOR.section_id
  is '科室ID，外键，待添加';
comment on column DOCDOR.password
  is '医生登录密码';
comment on column DOCDOR.description
  is '医生描述，可为空';
alter table DOCDOR
  add constraint EMPLOYEE_DOCTOR foreign key (EMPLOYEE_ID)
  references EMPLOYEE (EMPLOYEE_ID);

prompt Creating EQUIPMENT...
create table EQUIPMENT
(
  equipment_id   NUMBER not null,
  equipment_name VARCHAR2(45) not null,
  equipment_flag VARCHAR2(4) not null,
  buy_time       DATE not null,
  worse_time     DATE
)
;
comment on column EQUIPMENT.equipment_id
  is '设备编号';
comment on column EQUIPMENT.equipment_name
  is '设备名';
comment on column EQUIPMENT.equipment_flag
  is '设备使用情况';
comment on column EQUIPMENT.buy_time
  is '购买时间';
comment on column EQUIPMENT.worse_time
  is '报废时间';
alter table EQUIPMENT
  add constraint EQUIPMENT_ID primary key (EQUIPMENT_ID);

prompt Creating DOCTOR_MACHINE...
create table DOCTOR_MACHINE
(
  employee_id  NUMBER not null,
  equipment_id NUMBER not null,
  date_        DATE not null
)
;
comment on table DOCTOR_MACHINE
  is '医疗器械使用';
comment on column DOCTOR_MACHINE.employee_id
  is '医生ID';
comment on column DOCTOR_MACHINE.equipment_id
  is '设备ID';
comment on column DOCTOR_MACHINE.date_
  is '日期';
alter table DOCTOR_MACHINE
  add constraint DOTOR_MACHINE primary key (EMPLOYEE_ID, EQUIPMENT_ID, DATE_);
alter table DOCTOR_MACHINE
  add constraint EMPLOYEE_DOCTOR_MACHINE foreign key (EMPLOYEE_ID)
  references EMPLOYEE (EMPLOYEE_ID);
alter table DOCTOR_MACHINE
  add constraint EQUIPMENT_DOCROT_MACHINE foreign key (EQUIPMENT_ID)
  references EQUIPMENT (EQUIPMENT_ID);

prompt Creating DRUG...
create table DRUG
(
  drug_id     NUMBER not null,
  price       BINARY_DOUBLE not null,
  stock_num   NUMBER not null,
  description VARCHAR2(400),
  drug_name   VARCHAR2(45) not null
)
;
comment on column DRUG.drug_id
  is '药品ID';
comment on column DRUG.price
  is '单价';
comment on column DRUG.stock_num
  is '库存数量';
comment on column DRUG.description
  is '描述';
comment on column DRUG.drug_name
  is '药品名称';
alter table DRUG
  add constraint DRUG_ID primary key (DRUG_ID);

prompt Creating DRUG_PRES...
create table DRUG_PRES
(
  prescription_id NUMBER not null,
  drug_id         NUMBER not null
)
;
comment on column DRUG_PRES.prescription_id
  is '处方编号';
comment on column DRUG_PRES.drug_id
  is '药品编号';
alter table DRUG_PRES
  add constraint DRUG_PRES primary key (PRESCRIPTION_ID, DRUG_ID);
alter table DRUG_PRES
  add constraint DRUG_IN_PRES foreign key (DRUG_ID)
  references DRUG (DRUG_ID);

prompt Creating EMPLOYEE_JOB...
create table EMPLOYEE_JOB
(
  employee_id NUMBER not null,
  job_title   VARCHAR2(45) not null
)
;
comment on column EMPLOYEE_JOB.employee_id
  is '工号，外键';
comment on column EMPLOYEE_JOB.job_title
  is '职务名';
alter table EMPLOYEE_JOB
  add constraint EMPLOYEE_JOB primary key (EMPLOYEE_ID, JOB_TITLE);
alter table EMPLOYEE_JOB
  add constraint EMPLOYEE foreign key (EMPLOYEE_ID)
  references EMPLOYEE (EMPLOYEE_ID);

prompt Creating PATIENT...
create table PATIENT
(
  patient_id   NUMBER not null,
  patient_name VARCHAR2(45) not null,
  gender       VARCHAR2(45) not null,
  credit       VARCHAR2(45) not null,
  description  VARCHAR2(400)
)
;
comment on column PATIENT.patient_id
  is '病人唯一标识';
comment on column PATIENT.patient_name
  is '病人姓名';
comment on column PATIENT.gender
  is '病人性别';
comment on column PATIENT.credit
  is '身份证号';
comment on column PATIENT.description
  is '描述，可为空';
alter table PATIENT
  add constraint PATIENT_ID primary key (PATIENT_ID);

prompt Creating PATIENT_ACCOUNT...
create table PATIENT_ACCOUNT
(
  account_name VARCHAR2(45) not null,
  password     VARCHAR2(45) not null,
  patient_id   NUMBER not null
)
;
comment on table PATIENT_ACCOUNT
  is '病人登录';
comment on column PATIENT_ACCOUNT.account_name
  is '账号';
comment on column PATIENT_ACCOUNT.password
  is '密码';
comment on column PATIENT_ACCOUNT.patient_id
  is '病人编号';
alter table PATIENT_ACCOUNT
  add constraint ACCOUNT_PATIENT primary key (ACCOUNT_NAME);
alter table PATIENT_ACCOUNT
  add constraint PATIENT_ACCOUNT foreign key (PATIENT_ID)
  references PATIENT (PATIENT_ID);

prompt Creating PRESCIPTION...
create table PRESCIPTION
(
  prescription_id NUMBER not null,
  description     VARCHAR2(400) not null
)
;
comment on column PRESCIPTION.prescription_id
  is '处方号';
comment on column PRESCIPTION.description
  is '处方描述';
alter table PRESCIPTION
  add constraint PRESCRIPTION_DECRIPTION primary key (PRESCRIPTION_ID, DESCRIPTION);

prompt Creating SECTION...
create table SECTION
(
  section_id   NUMBER not null,
  section_name VARCHAR2(45) not null,
  section_pos  VARCHAR2(45) not null
)
;
comment on column SECTION.section_id
  is '科室编号';
comment on column SECTION.section_name
  is '科室名';
comment on column SECTION.section_pos
  is '位置';
alter table SECTION
  add constraint SECTION primary key (SECTION_ID);

prompt Creating REGISTER...
create table REGISTER
(
  patient_id  NUMBER not null,
  section_id  NUMBER not null,
  level_      VARCHAR2(45) not null,
  employee_id NUMBER
)
;
comment on column REGISTER.patient_id
  is '病人编号';
comment on column REGISTER.section_id
  is '科室编号';
comment on column REGISTER.level_
  is '职称';
comment on column REGISTER.employee_id
  is '医生编号';
alter table REGISTER
  add constraint PATIENT_REGISTER primary key (PATIENT_ID);
alter table REGISTER
  add constraint EMPLOYEE_REGISTER foreign key (EMPLOYEE_ID)
  references EMPLOYEE (EMPLOYEE_ID);
alter table REGISTER
  add constraint PATIENT_RES foreign key (PATIENT_ID)
  references PATIENT (PATIENT_ID);
alter table REGISTER
  add constraint SECTION_REGISTER foreign key (SECTION_ID)
  references SECTION (SECTION_ID);

prompt Creating "TREAT-COMMENT"...
create table "TREAT-COMMENT"
(
  treat_comment_id NUMBER not null,
  employee_id      NUMBER not null,
  score            NUMBER not null
)
;
comment on table "TREAT-COMMENT"
  is '就诊评价';
comment on column "TREAT-COMMENT".treat_comment_id
  is '评价编号';
comment on column "TREAT-COMMENT".employee_id
  is '医生编号';
comment on column "TREAT-COMMENT".score
  is '评分';
alter table "TREAT-COMMENT"
  add constraint COMMENT_ID primary key (TREAT_COMMENT_ID);
alter table "TREAT-COMMENT"
  add constraint EMPLOYEE_COMMENT foreign key (EMPLOYEE_ID)
  references EMPLOYEE (EMPLOYEE_ID);

prompt Creating TREAT_RECORD...
create table TREAT_RECORD
(
  treat_record_id NUMBER not null,
  patient_id      NUMBER not null,
  employee_id     NUMBER not null,
  treat_date      DATE not null,
  description     VARCHAR2(400)
)
;
comment on table TREAT_RECORD
  is '就医记录';
comment on column TREAT_RECORD.treat_record_id
  is '治疗记录编号';
comment on column TREAT_RECORD.patient_id
  is '病人号';
comment on column TREAT_RECORD.employee_id
  is '医生工号';
comment on column TREAT_RECORD.treat_date
  is '治疗时间';
comment on column TREAT_RECORD.description
  is '描述';
alter table TREAT_RECORD
  add constraint TREAT_RECORD primary key (TREAT_RECORD_ID);
alter table TREAT_RECORD
  add constraint EMPLOYEE_IN_TREAT foreign key (EMPLOYEE_ID)
  references EMPLOYEE (EMPLOYEE_ID);
alter table TREAT_RECORD
  add constraint PATIENT_IN_TREAT foreign key (PATIENT_ID)
  references PATIENT (PATIENT_ID);

prompt Creating TREAT_RECORD_DRUG...
create table TREAT_RECORD_DRUG
(
  treat_record_id NUMBER not null,
  drug_id         NUMBER not null,
  drug_num        NUMBER not null
)
;
comment on column TREAT_RECORD_DRUG.treat_record_id
  is '治疗记录编号';
comment on column TREAT_RECORD_DRUG.drug_id
  is '药品编号';
alter table TREAT_RECORD_DRUG
  add constraint DRUG_TREAT_RECORD primary key (TREAT_RECORD_ID);
alter table TREAT_RECORD_DRUG
  add constraint DRUG_IN_RECORD foreign key (DRUG_ID)
  references DRUG (DRUG_ID);
alter table TREAT_RECORD_DRUG
  add constraint RECORD_ID foreign key (TREAT_RECORD_ID)
  references TREAT_RECORD (TREAT_RECORD_ID);

prompt Creating WARD...
create table WARD
(
  ward_id     NUMBER not null,
  rest_num    NUMBER not null,
  description VARCHAR2(400),
  employee_id NUMBER not null
)
;
comment on column WARD.ward_id
  is '病房号';
comment on column WARD.rest_num
  is '可用床位';
comment on column WARD.description
  is '描述';
comment on column WARD.employee_id
  is '负责人，外键';
alter table WARD
  add constraint WARD_ID primary key (WARD_ID);
alter table WARD
  add constraint EMPLOYEE_WARD foreign key (EMPLOYEE_ID)
  references EMPLOYEE (EMPLOYEE_ID);

prompt Loading APPLY$_DEST_OBJ_CMAP...
prompt Table is empty
prompt Loading EMPLOYEE...
prompt Table is empty
prompt Loading DOCDOR...
prompt Table is empty
prompt Loading EQUIPMENT...
prompt Table is empty
prompt Loading DOCTOR_MACHINE...
prompt Table is empty
prompt Loading DRUG...
prompt Table is empty
prompt Loading DRUG_PRES...
prompt Table is empty
prompt Loading EMPLOYEE_JOB...
prompt Table is empty
prompt Loading PATIENT...
prompt Table is empty
prompt Loading PATIENT_ACCOUNT...
prompt Table is empty
prompt Loading PRESCIPTION...
prompt Table is empty
prompt Loading SECTION...
prompt Table is empty
prompt Loading REGISTER...
prompt Table is empty
prompt Loading "TREAT-COMMENT"...
prompt Table is empty
prompt Loading TREAT_RECORD...
prompt Table is empty
prompt Loading TREAT_RECORD_DRUG...
prompt Table is empty
prompt Loading WARD...
prompt Table is empty
set feedback on
set define on
prompt Done.
