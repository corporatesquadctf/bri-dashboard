INSERT INTO MODULE (ID,MODULE_NAME,MODULE_PATH,MODULE_STATUS,MODULE_TYPE,STATUS,ADDON,ADBY,MODION,MODYBY,ENVIRONMENT) VALUES 
(1,'Executive Summary                                 ','performance/exec_summary',NULL,1,0,NULL,NULL,NULL,NULL,'intranet')
,(2,'Segment Client By Profit                          ','perform/segment',NULL,1,0,NULL,NULL,NULL,NULL,'intranet')
,(3,'Top and Bottom                                    ','performance/topbottom',NULL,1,0,NULL,NULL,NULL,NULL,'intranet')
,(4,'Customer Leaderboard                              ','perform/customerleaderboards',NULL,1,0,NULL,NULL,NULL,NULL,'intranet')
,(5,'RM Leaderboard                                    ','perform/rmleaderboards',NULL,1,0,NULL,NULL,NULL,NULL,'intranet')
,(6,'Monitoring                                        ','report/monitoring',NULL,2,1,NULL,NULL,NULL,NULL,'intranet')
,(7,'Timeseries                                        ','report/timeseries',NULL,2,1,NULL,NULL,NULL,NULL,'intranet')
,(8,'User                                              ','admin/user_management/user',NULL,3,1,NULL,NULL,NULL,NULL,'intranet')
,(9,'Access Role                                       ','admin/user_management/access',NULL,3,1,NULL,NULL,NULL,NULL,'intranet')
,(10,'Role                                              ','admin/user_management/role',NULL,3,1,NULL,NULL,NULL,NULL,'intranet')
;
INSERT INTO MODULE (ID,MODULE_NAME,MODULE_PATH,MODULE_STATUS,MODULE_TYPE,STATUS,ADDON,ADBY,MODION,MODYBY,ENVIRONMENT) VALUES 
(11,'Menu                                              ','admin/user_management/menu',NULL,3,0,NULL,NULL,NULL,NULL,'intranet')
,(12,'Eskalasi                                          ','admin/configuration/escalation',NULL,5,0,NULL,NULL,NULL,NULL,'intranet')
,(13,'Delegasi                                          ','admin/configuration/delegation',NULL,5,1,NULL,NULL,NULL,NULL,'intranet')
,(14,'Divisions                                         ','admin/divisions',NULL,4,1,NULL,NULL,NULL,NULL,'intranet')
,(15,'Banks                                             ','admin/banks',NULL,4,1,NULL,NULL,NULL,NULL,'intranet')
,(16,'Parameter                                         ','admin/classifications',NULL,4,1,NULL,NULL,NULL,NULL,'intranet')
,(17,'Financial Highlights                              ','admin/financialgroups',NULL,4,0,NULL,NULL,NULL,NULL,'intranet')
,(18,'Banking Facilities                                ','admin/bankfacilities',NULL,4,0,NULL,NULL,NULL,NULL,'intranet')
,(19,'Division Relation                                 ','admin/divisionrelation',NULL,4,1,NULL,NULL,NULL,NULL,'intranet')
,(20,'Customers                                         ','admin/customer',NULL,4,1,NULL,NULL,NULL,NULL,'intranet')
;
INSERT INTO MODULE (ID,MODULE_NAME,MODULE_PATH,MODULE_STATUS,MODULE_TYPE,STATUS,ADDON,ADBY,MODION,MODYBY,ENVIRONMENT) VALUES 
(21,'Log                                               ','report/log',NULL,2,1,NULL,NULL,NULL,NULL,'intranet')
,(22,'Relationship Manager                              ','monitoring/relationshipmanager',NULL,6,1,NULL,NULL,NULL,NULL,'intranet')
,(23,'Account Planning                                  ','monitoring/AccountPlanning',NULL,6,1,NULL,NULL,NULL,NULL,'intranet')
,(24,'Draft List                                        ','pipeline/draft',NULL,7,1,NULL,NULL,NULL,NULL,'intranet')
,(25,'Submitted List                                    ','pipeline/submitted',NULL,7,1,NULL,NULL,NULL,NULL,'intranet')
,(26,'History                                           ','pipeline/history',NULL,7,1,NULL,NULL,NULL,NULL,'intranet')
,(27,'Account Planning                                  ','performance/AccountPlanning',NULL,1,1,NULL,NULL,NULL,NULL,'intranet')
,(28,'Log Scheduler Account Plannings                   ','log/importaccountplanning',NULL,8,1,NULL,NULL,NULL,NULL,'intranet')
,(29,'Log Scheduler Relationship Manager                ','log/importrm',NULL,8,1,NULL,NULL,NULL,NULL,'intranet')
,(30,'Disposisi                                         ','tasklist/disposisi',NULL,10,1,NULL,NULL,NULL,NULL,'intranet')
;
INSERT INTO MODULE (ID,MODULE_NAME,MODULE_PATH,MODULE_STATUS,MODULE_TYPE,STATUS,ADDON,ADBY,MODION,MODYBY,ENVIRONMENT) VALUES 
(31,'Account Planning                                  ','tasklist/AccountPlanning',NULL,9,1,NULL,NULL,NULL,NULL,'intranet')
,(32,'My Task                                           ','tasklist/MyTask',NULL,9,1,NULL,NULL,NULL,NULL,'intranet')
;