/*Person*/
INSERT INTO t_person (numeroAVS,perNom,perPrenom,perSexe,perDateNaissance,perNationalite,perLieuDeNaissance,perLieuOrigine,perQuotaDisponible,perMotDePasse) VALUES
("756.9731.4784.83" , "Oyarzabal" , "Mikel", TRUE, "1997-04-21" , "Espagnol", "Eibar", "Eibar", 4000.00, NULL),
("756.9731.4785.86" , "Scary"     , "Yann" ,TRUE , "1975-09-11" , "Martinique", "Fort-de-France", "Fort-de-France" ,4000.00 , NULL ),
("756.9731.4785.89" , "Pérez"   , "Lucas" ,TRUE , "1988-09-10" , "Espagnol" , "A Coruña", "A Coruña", 4000.00 , NULL),
("756.9731.4795.90" , "Sierro"   , "Félix" , TRUE, "1998-04-07" , "Suisse" , "Vevey", "Vevey", 4000.00 , NULL),
("756.4488.7226.70" , "Willy"   , "Boly" , TRUE, "1998-04-07" , "Suisse" , "Vevey", "Vevey", 4000.00 , NULL),
("756.4456.6576.96" , "Lois"   , "Mateo" , TRUE, "1998-04-07" , "Suisse" , "Vevey", "Vevey", 4000.00 , NULL),
("756.3450.8577.98" , "Josemaria"   , "Gutierrez" , TRUE, "1998-04-07" , "Suisse" , "Vevey", "Vevey", 4000.00 , NULL),
("756.0000.0000.00" , "Test"   , "Innoweeks" , FALSE, "2024-06-25" , "Suisse" , "Vevey", "Vevey", 4000.00 , NULL);


/*Voyage*/
INSERT INTO t_voyage(voyDateDepart, voyDateArrive, voyDepart, voyArrive, voyMotif, voyCoutCO2, numeroAVS) VALUES
("2024-01-10 8:00", "2024-03-20 9:30", "Genève(GVA)", "San Sebastian(EAS)", "Voir un ami Yago Iglesias Rodriguez", 218, "756.9731.4784.83"),
("2023-03-20 7:00", "2024-03-20 13:15", "Genève(GVA)", "Abu Dhabi(AUH)", "Visiter le Japon", 857, "756.9731.4785.86"),
("2023-03-20 15:00", "2024-03-21 1:00", "Abu Dhabi(AUH)", "Tokyo(NRT)", "Visiter le Japon", 1600, "756.9731.4785.86"),
("2024-04-26 10:00", "2024-02-26 12:15", "Genève(GVA)", "A Coruña(LCG)", "Voir un match avec un ami Yago Iglesias Rodriguez à Riazor", 299, "756.9731.4785.89"),
("2023-12-23 8:00", "2024-03-20 10:00", "Genève(GVA)", "Catane(CTA)", "Visiter la famille pour Noël", 305, "756.9731.4795.90");

