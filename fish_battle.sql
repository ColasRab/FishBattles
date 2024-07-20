-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 02:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fish_battle`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `rarity` enum('Common','Uncommon','Rare','Unique','Legendary') NOT NULL,
  `attack_points` int(11) DEFAULT NULL,
  `def_points` int(11) DEFAULT NULL,
  `type` enum('Fish','Spell','Trap') NOT NULL,
  `tributes_req` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `name`, `description`, `image_url`, `rarity`, `attack_points`, `def_points`, `type`, `tributes_req`) VALUES
('F0001', 'Amanieshrimp', 'When this card is tributed to summon another fish, add 500 to the attack damage of that fish.', 'assets/cards/AMANIE.png', 'Common', 400, 600, 'Fish', 0),
('F0002', 'Clara the Neon Tetra', 'When this card is targeted for an attack by another fish, negate that attack and put the attacking card to defense position. It works once every attacking phase.', 'assets/cards/TETRA.png', 'Common', 1200, 800, 'Fish', 0),
('F0003', 'Xīxuè the Chinese Algae Eater', 'Gain 1 Effect counter every standby phase. After getting 3 effect counters, you can attack the opponent’s life points, directly.', 'assets/cards/XIXUE.png', 'Common', 900, 500, 'Fish', 0),
('F0004', 'Angry Betta', 'During attack phase, add half of defense into its attack point. This effect can be only use once per attacking phase.', 'assets/cards/BETTA.png', 'Common', 1500, 1000, 'Fish', 0),
('F0005', 'Giga Apple', 'When this card is on the field in defense position, gain 200 defense points every standby phase.', 'assets/cards/GIGA.png', 'Common', 200, 1900, 'Fish', 0),
('F0006', 'Cardinal', 'When this card is destroyed by battle, gain 1000 life points', 'assets/cards/CARDINAL.png', 'Common', 300, 1900, 'Fish', 0),
('F0007', 'Lelouche', 'Discard this card to the grave. During standby phase, this card can be summoned into the field, ignoring the summoning conditions.', 'assets/cards/LELOUCHE.png', 'Common', 200, 200, 'Fish', 0),
('F0008', 'Gourami', 'Gourami, gou-gou-Gourami... Ildeohagi ileun Gourami', 'assets/cards/GOURAMI.png', 'Common', 1500, 1800, 'Fish', 0),
('F0009', 'Guppy', 'Guppies... Guppies... I love my guppies. Hope you like ‘em too...', 'assets/cards/GUPPY.png', 'Common', 1000, 1000, 'Fish', 0),
('F0010', 'Bob the Goldfish', 'During attack phase, Deals 10% extra damage to Defense position monsters.', 'assets/cards/BOB.png', 'Uncommon', 1300, 500, 'Fish', 0),
('F0011', 'Mr. Discussion', 'During attack phase, if in defense position, gain 500 defense points. If it is in attack position, gain 500 attack points.', 'assets/cards/DISCUS.png', 'Uncommon', 1500, 1500, 'Fish', 0),
('F0012', 'Flowerhorn', 'When this card is targeted for an attack by another fish while in defense position, reflect 20% of the damage to opponent\'s life points', 'assets/cards/FLOWERHORN.png', 'Uncommon', 100, 2500, 'Fish', 0),
('F0013', 'Archer Fish', 'Tribute 1 fish to summon this fish. During Attack Phase, if this card destroys a fish, return one card on the opponent\'s playing field to the hand.', 'assets/cards/ARCHER.png', 'Rare', 2500, 2000, 'Fish', 1),
('F0014', 'Flying Fish', 'Tribute 1 fish to summon this fish, During attack phase, you can attack the opponent\'s life points directly, with 50% less of the damage', 'assets/cards/FLYING.png', 'Rare', 1800, 100, 'Fish', 1),
('F0015', 'Starfish', 'Tribute 1 fish to summon this fish. This card can\'t be defeated by battle.', 'assets/cards/STAR.png', 'Rare', 700, 3000, 'Fish', 2),
('F0016', 'Electric Eel', 'Tribute 2 fishes to summon this fish. During attacking phase, once per two turns, destroy one fish.', 'assets/cards/ELECTRIC.png', 'Rare', 2500, 2300, 'Fish', 2),
('F0017', 'Mud Fish', 'Tribute 1 Fish to summon this fish. Just a ultra super dupa defensive fish :3', 'assets/cards/MUD.png', 'Rare', 200, 3500, 'Fish', 2),
('F0018', 'Pistol Shrimp', 'If Flip Summon, Destroy all fishes on the field.', 'assets/cards/PISTOL.png', 'Unique', 100, 1000, 'Fish', 0),
('F0019', 'Knife Fish', 'Tribute 2 fishes to summon this fish. If it destroys an opponent card in defense position by battle, inflict piercing battle damage to your opponent.', 'assets/cards/KNIFE.png', 'Unique', 2800, 2500, 'Fish', 2),
('F0020', 'Lion Fish', 'Tribute 2 fishes to summon this card. This fish is named after Nayeon <3', 'assets/cards/LION.png', 'Unique', 3000, 2000, 'Fish', 2),
('F0021', 'Jellyfish', 'Cannot be summoned with Normal / Tribute / Flip Summon. During standby phase, Target 1 opponent card and shift it to your playing Field. After 1 turn, destroy that fish. This card is not affected by card effects, nor monster effects', 'assets/cards/JELLYFISH.png', 'Legendary', 0, 5000, 'Fish', NULL),
('F0022', 'Gawr Gura', 'Cannot be summoned with Normal / Tribute / Flip Summon. It\'s not affected by card effects, nor monster effects', 'assets/cards/GURA.png', 'Legendary', 5000, 5000, 'Fish', NULL),
('F0023', 'Bee Goby-kun', 'During your opponent’s turn, at damage calculation: You can discard this card, you take no battle damage from that battle (Quick Effect)', 'assets/cards/BEEGOBY.png', 'Common', 300, 500, 'Fish', 0),
('F0024', 'Pyro Goby-kun', 'Shoots Flames that deals 30% of defeated fish\'s attack to opponent\'s life force', 'assets/cards/PYROGOBY.png', 'Common', 1900, 400, 'Fish', 0),
('F0025', 'Dia Goby-kun', 'Dia Goby likes cute things :3', 'assets/cards/DIAGOBY.png', 'Common', 0, 2000, 'Fish', 0),
('F0026', 'Ice Goby-kun', 'During attack phase, return an Opponent\'s Card to the Hand', 'assets/cards/ICEGOBY.png', 'Uncommon', 1800, 1000, 'Fish', 0),
('F0027', 'Shifter Goby-kun', 'During attack phase, destroy this fish and one fish from your opponent.', 'assets/cards/SHIFTER.png', 'Uncommon', 0, 0, 'Fish', 0),
('F0028', 'Doctor Goby-kun', 'Tribute 1 fish to summon this fish. Every standby phase, gain 500 Life Points as long as this fish is on the field.', 'assets/cards/DOCTOR.png', 'Rare', 800, 2300, 'Fish', 1),
('F0029', 'Gold Goby', 'Tribute 1 fish to summon this fish. \"im just a sturdy Goby\" *insert Phonk music.', 'assets/cards/GOLDGOBY.png', 'Rare', 2300, 1800, 'Fish', 1),
('F0030', 'Knight Goby-kun', 'Tribute 2 fishes to summon this fish. During attack phase, when in battle, gain 50% of the defense as additional attack damage', 'assets/cards/KNIGHT.png', 'Unique', 2000, 1800, 'Fish', 2),
('F0031', 'Goby King', 'Cannot be summoned with Normal / Tribute / Flip Summon. It\'s not affected by card effects, nor monster effects', 'assets/cards/GOBYKING.png', 'Legendary', 5000, 5000, 'Fish', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `coins` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pearls` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `user_id`, `coins`, `pearls`) VALUES
(6, 33, 0.00, 10.00);

-- --------------------------------------------------------

--
-- Table structure for table `decks`
--

CREATE TABLE `decks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cards` longtext DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `decks`
--

INSERT INTO `decks` (`id`, `user_id`, `cards`, `name`, `description`) VALUES
(13, 33, 'F0001,F0001,F0001,F0002,F0002,F0002,F0004,F0004,F0004,F0006,F0006,F0006,F0009,F0009,F0009,F0011,F0011,F0011,F0014,F0014,F0016,F0017', 'Starter Deck', 'A deck of cards given to all new players');

-- --------------------------------------------------------

--
-- Table structure for table `effects`
--

CREATE TABLE `effects` (
  `id` int(11) NOT NULL,
  `cards_id` varchar(11) NOT NULL,
  `effect_condition` enum('attacking_phase','standby_phase') DEFAULT NULL,
  `effect_addtl_condition` enum('self_defense_position','new_dead','dead','on_hand','target_defense_position','self_defense_position','self_attack_position','destroys_monster','flipped_summon') DEFAULT NULL,
  `effect_keyword` enum('battle_immunity','bring_to_grave','damage_affect_exponent','damage_affect_static','damage_increase_exponent','damage_increase_static','defense_increase_static','destroy','heal','mind_control','negate','return_card_to_hand','revive','rotate') DEFAULT NULL,
  `effect_amount` varchar(20) DEFAULT NULL,
  `effect_source` varchar(20) DEFAULT NULL,
  `effect_target` varchar(30) DEFAULT NULL,
  `effect_cooldown` int(2) DEFAULT NULL,
  `effect_activation` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`) VALUES
(33, '_Colas', '202210874@fit.edu.ph', '$2y$10$LLGHLu5swB1QgAsWDTWRIeZAc4aQq7uzHRn4MIbM6Nw92PLhLDNQe');

-- --------------------------------------------------------

--
-- Table structure for table `user_cards`
--

CREATE TABLE `user_cards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `card_string` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cards`
--

INSERT INTO `user_cards` (`id`, `user_id`, `card_string`) VALUES
(9, 33, 'F0001,F0001,F0001,F0002,F0002,F0002,F0004,F0004,F0004,F0006,F0006,F0006,F0009,F0009,F0009,F0011,F0011,F0011,F0014,F0014,F0016,F0017,F0006,');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `decks`
--
ALTER TABLE `decks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `effects`
--
ALTER TABLE `effects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- Indexes for table `user_cards`
--
ALTER TABLE `user_cards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `decks`
--
ALTER TABLE `decks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `effects`
--
ALTER TABLE `effects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_cards`
--
ALTER TABLE `user_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `currency`
--
ALTER TABLE `currency`
  ADD CONSTRAINT `currency_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `decks`
--
ALTER TABLE `decks`
  ADD CONSTRAINT `decks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_cards`
--
ALTER TABLE `user_cards`
  ADD CONSTRAINT `user_cards_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
