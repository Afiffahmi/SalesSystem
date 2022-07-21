-- Generated by Oracle SQL Developer Data Modeler 21.4.2.059.0838
--   at:        2022-07-20 19:52:05 SGT
--   site:      Oracle Database 11g
--   type:      Oracle Database 11g



CREATE USER ggatorart 
    IDENTIFIED BY  
    DEFAULT TABLESPACE SYSTEM 
    ACCOUNT UNLOCK 
;

GRANT CREATE ANY MEASURE FOLDER, CREATE ANY CUBE, ALTER ANY CUBE DIMENSION, EXECUTE ASSEMBLY, DROP ANY ASSEMBLY, CREATE ANY ASSEMBLY, MANAGE FILE GROUP, EXECUTE ANY PROGRAM, CREATE ANY RULE, DROP ANY RULE SET, EXECUTE ANY EVALUATION CONTEXT, ON COMMIT REFRESH, DROP ANY CONTEXT, CREATE ANY CONTEXT, DEQUEUE ANY QUEUE, MANAGE ANY QUEUE, EXECUTE ANY INDEXTYPE, UNDER ANY VIEW, DROP ANY MATERIALIZED VIEW, DROP ANY PROCEDURE, ALTER ANY ROLE, DROP PUBLIC DATABASE LINK, CREATE PUBLIC DATABASE LINK, CREATE CLUSTER, SELECT ANY TABLE, BECOME USER, CREATE SESSION, ADMINISTER SQL MANAGEMENT OBJECT, UPDATE ANY CUBE BUILD PROCESS, CREATE CUBE BUILD PROCESS, DROP ANY CUBE, CREATE ANY CUBE DIMENSION, COMMENT ANY MINING MODEL, ALTER ANY MINING MODEL, SELECT ANY MINING MODEL, EXECUTE ANY ASSEMBLY, ALTER ANY ASSEMBLY, READ ANY FILE GROUP, DROP ANY SQL PROFILE, CREATE JOB, ALTER ANY RULE SET, ALTER ANY OUTLINE, DROP ANY INDEXTYPE, ALTER ANY INDEXTYPE, CREATE OPERATOR, EXECUTE ANY LIBRARY, DROP ANY DIRECTORY, GRANT ANY PRIVILEGE, DROP PROFILE, CREATE ANY TRIGGER, CREATE ANY PROCEDURE, CREATE PROCEDURE, CREATE VIEW, ALTER ANY CLUSTER, CREATE ANY CLUSTER, COMMENT ANY TABLE, BACKUP ANY TABLE, ALTER ROLLBACK SEGMENT, MANAGE TABLESPACE, UPDATE ANY CUBE DIMENSION, SELECT ANY CUBE, CREATE ASSEMBLY, DROP ANY EDITION, ADVISOR, DROP ANY EVALUATION CONTEXT, GRANT ANY OBJECT PRIVILEGE, RESUMABLE, DROP ANY OUTLINE, DROP ANY DIMENSION, UNDER ANY TABLE, UNDER ANY TYPE, ALTER ANY TYPE, CREATE TYPE, ALTER ANY MATERIALIZED VIEW, FORCE ANY TRANSACTION, FORCE TRANSACTION, DROP ANY VIEW, CREATE ANY VIEW, DROP PUBLIC SYNONYM, DROP ANY SYNONYM, CREATE TABLE, DROP USER, ALTER USER, ALTER TABLESPACE, FLASHBACK ARCHIVE ADMINISTER, DROP ANY CUBE BUILD PROCESS, ALTER ANY CUBE, CREATE CUBE, SELECT ANY CUBE DIMENSION, ALTER ANY EDITION, CREATE EXTERNAL JOB, EXECUTE ANY CLASS, CREATE ANY JOB, CREATE RULE, CREATE ANY RULE SET, CREATE ANY EVALUATION CONTEXT, ALTER ANY DIMENSION, DROP ANY OPERATOR, DROP ANY LIBRARY, EXECUTE ANY TYPE, DROP ANY TYPE, CREATE ANY TYPE, ALTER PROFILE, ALTER ANY PROCEDURE, DROP ANY ROLE, ALTER ANY INDEX, UPDATE ANY TABLE, LOCK ANY TABLE, ALTER ANY TABLE, CREATE ROLLBACK SEGMENT, AUDIT SYSTEM, INSERT ANY CUBE DIMENSION, CREATE CUBE DIMENSION, DROP ANY MINING MODEL, ALTER ANY RULE, EXECUTE ANY RULE SET, DEBUG CONNECT SESSION, MERGE ANY VIEW, CREATE DIMENSION, GLOBAL QUERY REWRITE, QUERY REWRITE, CREATE ANY INDEXTYPE, CREATE ANY OPERATOR, ALTER ANY LIBRARY, ANALYZE ANY, CREATE PROFILE, DROP ANY TRIGGER, CREATE ANY SYNONYM, CREATE ANY INDEX, DROP ANY TABLE, CREATE USER, DROP TABLESPACE, CREATE TABLESPACE, RESTRICTED SESSION, CREATE ANY SQL PROFILE, ADMINISTER ANY SQL TUNING SET, SELECT ANY TRANSACTION, IMPORT FULL DATABASE, EXPORT FULL DATABASE, ADMINISTER DATABASE TRIGGER, CREATE ANY DIMENSION, CREATE INDEXTYPE, CREATE LIBRARY, CREATE ANY DIRECTORY, CREATE ANY MATERIALIZED VIEW, ALTER ANY TRIGGER, CREATE TRIGGER, EXECUTE ANY PROCEDURE, ALTER DATABASE, CREATE DATABASE LINK, DROP ANY SEQUENCE, DELETE ANY TABLE, INSERT ANY TABLE, CREATE ANY CUBE BUILD PROCESS, DROP ANY MEASURE FOLDER, DELETE ANY MEASURE FOLDER, UPDATE ANY CUBE, DROP ANY CUBE DIMENSION, DELETE ANY CUBE DIMENSION, CREATE ANY MINING MODEL, CREATE ANY EDITION, MANAGE ANY FILE GROUP, DROP ANY RULE, CREATE RULE SET, CREATE EVALUATION CONTEXT, FLASHBACK ANY TABLE, DEBUG ANY PROCEDURE, CREATE ANY OUTLINE, EXECUTE ANY OPERATOR, ALTER ANY OPERATOR, CREATE ANY LIBRARY, CREATE MATERIALIZED VIEW, GRANT ANY ROLE, ALTER ANY SEQUENCE, CREATE ANY SEQUENCE, CREATE SEQUENCE, CREATE PUBLIC SYNONYM, CREATE SYNONYM, DROP ANY CLUSTER, ALTER SESSION, ALTER SYSTEM, INSERT ANY MEASURE FOLDER, CREATE MEASURE FOLDER, CREATE MINING MODEL, CHANGE NOTIFICATION, ADMINISTER SQL TUNING SET, ALTER ANY SQL PROFILE, MANAGE SCHEDULER, EXECUTE ANY RULE, ALTER ANY EVALUATION CONTEXT, ADMINISTER RESOURCE MANAGER, ENQUEUE ANY QUEUE, ALTER RESOURCE COST, AUDIT ANY, CREATE ROLE, SELECT ANY SEQUENCE, DROP ANY INDEX, CREATE ANY TABLE,
 drop rollback segment, unlimited tablespace to ggatorart;

-- predefined type, no DDL - MDSYS.SDO_GEOMETRY

-- predefined type, no DDL - XMLTYPE

CREATE TABLE ggatorart.customers (
    cust_id    NUMBER NOT NULL,
    cust_name  VARCHAR2(30 BYTE),
    address    VARCHAR2(50 BYTE),
    cust_phone VARCHAR2(11 BYTE),
    email      VARCHAR2(30 BYTE),
    attachment VARCHAR2(50 BYTE)
)
PCTFREE 10 PCTUSED 40 TABLESPACE system LOGGING
    STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT );

ALTER TABLE ggatorart.customers
    ADD CONSTRAINT customers_pk PRIMARY KEY ( cust_id )
        USING INDEX PCTFREE 10 INITRANS 2 TABLESPACE system LOGGING
            STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL
            DEFAULT );

CREATE TABLE ggatorart.invoice (
    invoice_id   VARCHAR2(11 BYTE) NOT NULL,
    total_amount NUMBER,
    invoice_date DATE,
    staff_id     VARCHAR2(11 BYTE)
)
PCTFREE 10 PCTUSED 40 TABLESPACE system LOGGING
    STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT );

ALTER TABLE ggatorart.invoice
    ADD CONSTRAINT invoice_pk PRIMARY KEY ( invoice_id )
        USING INDEX PCTFREE 10 INITRANS 2 TABLESPACE system LOGGING
            STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL
            DEFAULT );

CREATE TABLE ggatorart.order_product (
    orp_id         VARCHAR2(10 BYTE) NOT NULL,
    order_quantity NUMBER,
    subtotal_order FLOAT(100),
    order_id       VARCHAR2(10 BYTE),
    product_id     VARCHAR2(10 BYTE)
)
PCTFREE 10 PCTUSED 40 TABLESPACE system LOGGING
    STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT );

ALTER TABLE ggatorart.order_product
    ADD CONSTRAINT order_product_pk PRIMARY KEY ( orp_id )
        USING INDEX PCTFREE 10 INITRANS 2 TABLESPACE system LOGGING
            STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL
            DEFAULT );

CREATE TABLE ggatorart.orders (
    order_id   VARCHAR2(10 BYTE) NOT NULL,
    order_date DATE,
    cust_id    NUMBER,
    invoice_id VARCHAR2(11 BYTE)
)
PCTFREE 10 PCTUSED 40 TABLESPACE system LOGGING
    STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT );

ALTER TABLE ggatorart.orders
    ADD CONSTRAINT orders_pk PRIMARY KEY ( order_id )
        USING INDEX PCTFREE 10 INITRANS 2 TABLESPACE system LOGGING
            STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL
            DEFAULT );

CREATE TABLE ggatorart.products (
    product_id       VARCHAR2(10 BYTE) NOT NULL,
    product_name     VARCHAR2(30 BYTE),
    product_category VARCHAR2(15 BYTE),
    product_price    NUMBER,
    attachment       VARCHAR2(50 BYTE)
)
PCTFREE 10 PCTUSED 40 TABLESPACE system LOGGING
    STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT );

ALTER TABLE ggatorart.products
    ADD CONSTRAINT products_pk PRIMARY KEY ( product_id )
        USING INDEX PCTFREE 10 INITRANS 2 TABLESPACE system LOGGING
            STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL
            DEFAULT );

CREATE TABLE ggatorart.staffs (
    staff_id      VARCHAR2(10 BYTE) NOT NULL,
    staff_name    VARCHAR2(30 BYTE),
    staff_phone   VARCHAR2(11 BYTE),
    email         VARCHAR2(30 BYTE),
    supervisor_id VARCHAR2(10 BYTE),
    attachment    VARCHAR2(50 BYTE),
    size_file     VARCHAR2(50 BYTE),
    type_file     VARCHAR2(50 BYTE),
    address       VARCHAR2(30 BYTE),
    passwords     VARCHAR2(30 BYTE)
)
PCTFREE 10 PCTUSED 40 TABLESPACE system LOGGING
    STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT );

CREATE UNIQUE INDEX ggatorart.staff_supervisor ON
    ggatorart.staffs (
        supervisor_id
    ASC )
        TABLESPACE system PCTFREE 10
            STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL
            DEFAULT )
        LOGGING;

ALTER TABLE ggatorart.staffs
    ADD CONSTRAINT staffs_pk PRIMARY KEY ( staff_id )
        USING INDEX PCTFREE 10 INITRANS 2 TABLESPACE system LOGGING
            STORAGE ( INITIAL 65536 NEXT 1048576 PCTINCREASE 0 MINEXTENTS 1 MAXEXTENTS 2147483645 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL
            DEFAULT );

ALTER TABLE ggatorart.staffs
    ADD CONSTRAINT staff_supervisor UNIQUE ( supervisor_id )
        USING INDEX ggatorart.staff_supervisor;

ALTER TABLE ggatorart.invoice
    ADD CONSTRAINT invoice FOREIGN KEY ( staff_id )
        REFERENCES ggatorart.staffs ( staff_id )
    NOT DEFERRABLE;

ALTER TABLE ggatorart.staffs
    ADD CONSTRAINT staff_mgr FOREIGN KEY ( supervisor_id )
        REFERENCES ggatorart.staffs ( supervisor_id )
    NOT DEFERRABLE;

ALTER TABLE ggatorart.order_product
    ADD FOREIGN KEY ( order_id )
        REFERENCES ggatorart.orders ( order_id )
    NOT DEFERRABLE;

ALTER TABLE ggatorart.order_product
    ADD FOREIGN KEY ( product_id )
        REFERENCES ggatorart.products ( product_id )
    NOT DEFERRABLE;

ALTER TABLE ggatorart.orders
    ADD FOREIGN KEY ( cust_id )
        REFERENCES ggatorart.customers ( cust_id )
    NOT DEFERRABLE;

ALTER TABLE ggatorart.orders
    ADD FOREIGN KEY ( invoice_id )
        REFERENCES ggatorart.invoice ( invoice_id )
    NOT DEFERRABLE;



-- Oracle SQL Developer Data Modeler Summary Report: 
-- 
-- CREATE TABLE                             6
-- CREATE INDEX                             1
-- ALTER TABLE                             13
-- CREATE VIEW                              0
-- ALTER VIEW                               0
-- CREATE PACKAGE                           0
-- CREATE PACKAGE BODY                      0
-- CREATE PROCEDURE                         0
-- CREATE FUNCTION                          0
-- CREATE TRIGGER                           0
-- ALTER TRIGGER                            0
-- CREATE COLLECTION TYPE                   0
-- CREATE STRUCTURED TYPE                   0
-- CREATE STRUCTURED TYPE BODY              0
-- CREATE CLUSTER                           0
-- CREATE CONTEXT                           0
-- CREATE DATABASE                          0
-- CREATE DIMENSION                         0
-- CREATE DIRECTORY                         0
-- CREATE DISK GROUP                        0
-- CREATE ROLE                              0
-- CREATE ROLLBACK SEGMENT                  0
-- CREATE SEQUENCE                          0
-- CREATE MATERIALIZED VIEW                 0
-- CREATE MATERIALIZED VIEW LOG             0
-- CREATE SYNONYM                           0
-- CREATE TABLESPACE                        0
-- CREATE USER                              1
-- 
-- DROP TABLESPACE                          0
-- DROP DATABASE                            0
-- 
-- REDACTION POLICY                         0
-- 
-- ORDS DROP SCHEMA                         0
-- ORDS ENABLE SCHEMA                       0
-- ORDS ENABLE OBJECT                       0
-- 
-- ERRORS                                   0
-- WARNINGS                                 0
