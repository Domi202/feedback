#
# Table structure for table 'tx_feedback_domain_model_feedback'
#
CREATE TABLE tx_feedback_domain_model_feedback (
  uid int(11) unsigned NOT NULL auto_increment,
  pid int(11) unsigned DEFAULT '0' NOT NULL,

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	type varchar(255) DEFAULT '' NOT NULL,
	user int(11) DEFAULT '0' NOT NULL,

	url tinytext,
	comment text,

  PRIMARY KEY (uid),
  KEY parent (pid)
);
