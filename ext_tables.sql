#
# Add SQL definition of database tables
#

#
# Table structure for "tx_t3monitoring_log"
#
CREATE TABLE tx_t3monitoring_log
(
    uid             int(11) NOT NULL auto_increment,
    pid             int(11) DEFAULT '0' NOT NULL,

    tstamp          int(11) unsigned DEFAULT '0' NOT NULL,
    crdate          int(11) unsigned DEFAULT '0' NOT NULL,
    cruser_id       int(11) unsigned DEFAULT '0' NOT NULL,
    deleted         tinyint(4) DEFAULT '0' NOT NULL,
    hidden          tinyint(4) DEFAULT '0' NOT NULL,

    `type` tinyint(4) DEFAULT '0' NOT NULL,
    ignore tinyint(4) DEFAULT '0' NOT NULL,
    reviewed tinyint(4) DEFAULT '0' NOT NULL,
    device_type varchar(255) DEFAULT '' NOT NULL,
    browser varchar(255) DEFAULT '' NOT NULL,
    browser_version varchar(255) DEFAULT '' NOT NULL,
    `level` int(11) unsigned DEFAULT '0' NOT NULL,
    os varchar(255) DEFAULT '' NOT NULL,
    os_version varchar(255) DEFAULT '' NOT NULL,
    url varchar(255) DEFAULT '' NOT NULL,
    `user` int(11) unsigned DEFAULT '0' NOT NULL,
    error_data text,
    message text,
    ip_address varchar(255) DEFAULT '' NOT NULL,

    PRIMARY KEY (uid),
    KEY             parent (pid),
);