--
-- Data for table User
--

INSERT INTO `User` (`id`, `acronym`, `name`, `email`, `password`, `gravatar`, `posts`, `created`) VALUES
(1, 'dani1', 'Daniel', 'daniel@yahoo.com', '$2y$10$JsfU2a5RpAwQIO1TPGN5Xu0/E2FAo/jBdNtNB5u.tsZ9pCPM0p8mu', 'https://www.gravatar.com/avatar/e8f710ddf1540b8b1b7c2484b4a589db?d=retro', 4, '2019-01-11 14:39:27'),
(2, 'nina1', 'Nina', 'nina@gmail.com', '$2y$10$0higxO7jcbPfNvqAYjezw.bTXtBoaVRM80x8XdE.N7MPRcqJ6GjNK', 'https://www.gravatar.com/avatar/30d4a31415648af1262bda44e37bda88?d=retro', 4, '2019-01-11 14:49:17'),
(3, 'niko1', 'Niko', 'nikolas@hotmail.com', '$2y$10$jrGiyxRd2RoCyB8HesyDiOwNrnV7Al5vw78i.T4AvOpcGPU6oD/5.', 'https://www.gravatar.com/avatar/70ca0c056017fb74d5a44fef6e4ae84e?d=retro', 4, '2019-01-11 15:27:10'),
(4, 'moto1', 'MotoFanatic', 'motofan@gmail.com', '$2y$10$ER9nC0Iuwb/5/UBMw6efjuREjVNL6raD9/sR/qVd/MOvOSQfVlDme', 'https://www.gravatar.com/avatar/4bf7e29b003d6e4259055df19b6cc2cc?d=retro', 3, '2019-01-11 15:35:55'),
(5, 'doha1', 'Dohan', 'dohan@gmail.au', '$2y$10$ktwA1tFzpiYm2NOOq5lvsunSNc6FlFdr6UbBjrsuMJQm1Pltx10ku', 'https://www.gravatar.com/avatar/bc7c1f63c0e70675642ab45fd269c37a?d=retro', 3, '2019-01-11 15:49:53');


--
-- Data for table Question
--
INSERT INTO `Question` (`id`, `title`, `body`, `tags`, `userid`, `created`) VALUES
(2, 'Lorenzo about to sign for Honda 2019?', 'It seems that Jorge Lorenzo will join the Honda team. Is that a good move?', 'lorenzo,honda', 1, '2019-01-11 14:48:38'),
(3, 'Marquez the greatest ever?', 'Marquez won his 5th MotoGP title.  Could he become the best rider ever? ', 'marquez', 3, '2019-01-11 15:29:50'),
(4, 'Is the calendar for the 2019 season out?', 'I would want to see Rossi in Mugello this year. Anyone knows the dates for the 2019 events?', 'rossi,mugello', 4, '2019-01-11 15:43:47'),
(5, 'Does anyone remember Michael Dohan?', 'I saw an interview with Michael Dohan and Marc Marquez. Great dude!', 'dohan,marquez', 5, '2019-01-11 15:51:19'),
(6, 'Can Rossi and Yamaha beat Honda in 2019?', 'Rossi will stay in Yamaha one more year. I hope he has a chance this year. ', 'rossi,honda,yamaha', 5, '2019-01-11 15:52:54'),
(8, 'Will Marquez leave Honda in the future?', 'I would like to see him in another team.', 'honda,marquez', 2, '2019-01-11 16:24:43');


--
-- Data for table Answer
--
INSERT INTO `Answer` (`id`, `body`, `questionid`, `userid`, `created`) VALUES
(1, 'I think it is a great move for him, but not so much for the team. He is a troublemaker. ', 2, 2, '2019-01-11 14:50:29'),
(2, 'I think so. He is only 25 years old! ', 3, 2, '2019-01-11 15:31:46'),
(3, 'Yes, the Italian GP is on the 2nd of June. ', 4, 1, '2019-01-11 15:44:58'),
(4, 'Rossi is still fast, but the Honda boys will be tough to beat.', 6, 3, '2019-01-11 15:54:20'),
(6, 'He won 5 titles in a row! One of the greatest. ', 5, 3, '2019-01-11 16:02:03');


--
-- Data for table Comment
--
INSERT INTO `Comment` (`id`, `body`, `questionid`, `answerid`, `userid`, `created`) VALUES
(4, 'I agree.', NULL, 1, 1, '2019-01-11 15:26:04'),
(5, '26 next month :)', NULL, 2, 1, '2019-01-11 15:32:49'),
(6, 'Ok. ', NULL, 2, 2, '2019-01-11 15:35:01'),
(7, '5 + 2 (moto2 + 125cc)', 3, NULL, 4, '2019-01-11 15:37:17'),
(8, 'I miss Monza.', 4, NULL, 3, '2019-01-11 15:46:44'),
(9, 'Me too! Mugello is really good though.', 4, NULL, 4, '2019-01-11 15:48:28'),
(10, 'Yes, he did. Amazing!', NULL, 6, 5, '2019-01-11 16:02:57');


--
-- Data for table Tag
--
INSERT INTO `Tag` (`id`, `questionid`, `name`) VALUES
(4, 2, 'lorenzo'),
(5, 2, 'honda'),
(6, 3, 'marquez'),
(7, 4, 'rossi'),
(8, 4, 'mugello'),
(9, 5, 'dohan'),
(10, 5, 'marquez'),
(11, 6, 'rossi'),
(12, 6, 'honda'),
(13, 6, 'yamaha'),
(16, 8, 'honda'),
(17, 8, 'marquez');
