CREATE TABLE `newslettercontacts` (
 `id` bigint(20) NOT NULL,
 `email` varchar(64) NOT NULL,
 `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
 `updated_at` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `newslettercontacts`
--
ALTER TABLE `newslettercontacts`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `newslettercontacts`
--
ALTER TABLE `newslettercontacts`
 MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;