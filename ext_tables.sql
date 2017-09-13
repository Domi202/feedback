#
# Table structure for table 'tx_feedback_domain_model_feedbacktype'
#
CREATE TABLE tx_feedback_domain_model_feedbacktype (
  uid int(11) unsigned NOT NULL auto_increment,
  pid int(11) unsigned DEFAULT '0' NOT NULL,

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,

	title varchar(255) DEFAULT '' NOT NULL,

  PRIMARY KEY (uid),
  KEY parent (pid)
);

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

	type int(11) DEFAULT '0' NOT NULL,

	fe_user int(11) DEFAULT '0' NOT NULL,
	be_user int(11) DEFAULT '0' NOT NULL,
	answers int(11) DEFAULT '0' NOT NULL,

	url tinytext,
	comment text,
	data text,

  PRIMARY KEY (uid),
  KEY parent (pid)
);

#
# Table structure for table 'tx_feedback_domain_model_answer'
#
CREATE TABLE tx_feedback_domain_model_answer (
  uid int(11) unsigned NOT NULL auto_increment,
  pid int(11) unsigned DEFAULT '0' NOT NULL,

  tstamp int(11) unsigned DEFAULT '0' NOT NULL,
  crdate int(11) unsigned DEFAULT '0' NOT NULL,
  deleted tinyint(4) unsigned DEFAULT '0' NOT NULL,
  hidden tinyint(4) unsigned DEFAULT '0' NOT NULL,

	feedback int(11) DEFAULT '0' NOT NULL,
	fe_user int(11) DEFAULT '0' NOT NULL,
	be_user int(11) DEFAULT '0' NOT NULL,

	comment text,

  PRIMARY KEY (uid),
  KEY parent (pid)
);
