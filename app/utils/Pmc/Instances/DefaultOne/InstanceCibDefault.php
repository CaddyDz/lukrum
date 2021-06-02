<?php


namespace App\utils\Pmc\Instances\DefaultOne;




class InstanceCibDefault extends \App\utils\Pmc\Instances\InstanceCibHardcodedAbstract implements \App\utils\Pmc\Instances\Contracts\InstanceCibContract
{
    protected static $copies = [
        'setup' => [
            'copies_overview' => true,
            'profile' => true,
        ],
        'common' => [
            'tp1' => [
                'enabled' => true,
                'pages' => ['banner', 'sm', 'email', ],
                'title' => 'Intro',
                'short_title' => 'Intro',
                'long_title' => '"Intro" Touchpoint',
                'banner_cta' => [
                    'Discover Digital 360',
                    'Learn how we can help',
                    'Explore Digital 360',
                    'See how we can help',
                    'Power your transformation',
                    'Let\'s talk Digital 360',
                    'Unlock Digital 360',
                ],

                'sm_cta' => [
                    'Discover Digital 360',
                    'Learn about Digital 360',
                ],

                'landing_subhead' => [],
                'landing_intro' => [],
                'landing_body' => [],
                'landing_cta' => [],

                'email_intro' => [
                    'Create more “WOW!” moments for your customers with Digital 360 from Salesforce.',
                    'Ready to turn customer data into customer love?',
                    'Do what you do best, only better.',
                ],
                'email_body' => [
                    'It’s the solution that connects all your data – across teams, devices and systems – so that you can see the world through your customers’ eyes and put them at the heart of everything you do. Deploy marketing campaigns that are personized, relevant and helpful. Offer shopping that’s easy and seamless, across channels. Create rewarding customer experiences that build loyalty. Take a look at our blog post for a high-level overview of what Digital 360 can do for your business, and your customers. Of course, we’d be happy to answer any questions you have.',
                    'Let’s talk about Digital 360 from Salesforce. It’s the solution that connects all your data – across teams, devices and systems – so you can see the world through your customers’ eyes and put them at the heart of everything you do. That means you can deploy personalized marketing campaigns, offer seamless shopping across channels and create rewarding customer experiences that build loyalty. Take a look at our blog post for a high-level overview of what Digital 360 can do for your business, and your customers. Of course, we’d be happy to answer any questions you have.',
                    'When it comes to technology, most industry leaders are always looking for the most up-to-date software or service in order to gain a competitive edge. With Digital 360 being the new industry standard for data-driven marketing campaigns, it’s everything your company has been looking for. Allow us to introduce Digital 360, the new mecca of data. Designed to keep your campaigns carefully targeted and seamlessly connected, Digital 360 allows you the capabilities of communicating with your customers at their preferred level of engagement. Dive into our blog post for a more detailed overview of all the ways your business will benefit from elevating your online presence. Give your company the competitive edge it needs.',
                ],
                'email_cta' => [
                    'Read The Digital 360 Blog',
                    'Read Our Blog for More',
                    'Dive In!',
                ],
            ],

            'tp2' => [
                'enabled' => true,
                'pages' => ['banner', 'sm', 'landing', 'email', ],
                'title' => 'Why',
                'short_title' => 'Why',
                'long_title' => '"Why" Touchpoint',
                'banner_cta' => [
                    'Get the Report',
                    'See the State of Commerce',
                    'Learn from the leaders',
                ],
                'sm_cta' => [
                    'Get the report',
                    'Read the report',
                    'Get the details',
                    'Learn from experts',
                    'Learn how',
                    'Learn more',
                ],
                'landing_subhead' => [
                    'Do what you do best, only better.',
                    'Let’s turn today’s data into tomorrow’s happy customers',
                    'Better experiences, stronger relationships.',
                ],
                'landing_intro' => [
                    'Don’t just keep pace, set the pace.',
                    'More connection, less complication.',
                    'The State of Commerce Report is yours.',
                ],
                'landing_body' => [
                    'Check out our brand new State of Commerce Report to get a deep understanding of the current consumer trends in your industry. Gain insider knowledge by tracking exactly how your customers are acclimating to an ever-changing, digital-first world, and use that information to set the pace of your next business strategy. Plus, learn how Digital 360 has benefited others, and more importantly, what it can do for you.',
                    'Gain access to our free State of Commerce Report and get important information on how the pandemic has affected the recent trends of both consumers (B2C) and businesses (B2B) in the digital commerce space. Learn how Digital 360 has become the new business standard for today’s top companies, and see how your business can begin competing at the same level.',
                    'Get your complimentary State of Commerce Report and see how industry leaders have kept up with – and even exceeded – customer expectations in rapidly changing times. Learn how Digital 360 from Salesforce can help you do the same.',
                    'See how industry leaders have kept up with – and even exceeded – customer expectations in rapidly changing times. Learn how Digital 360 from Salesforce can help you do the same by unifying data from across your organization to create experiences people love.',
                ],
                'landing_cta' => [
                    'Get the report',
                    'Read the report',
                ],

                'email_intro' => [
                    'Today’s data into tomorrow’s happy customers.',
                    'Make sure you’re living in the same world as your customers.',
                    'Think globally. Target locally.',

                ],
                'email_body' => [
                    'It’s been a time like no other. While digital transformation has been on everyone’s minds for a while, the pace of change over the last year has been unprecedented. That’s why our partners at Salesforce have created the State of Commerce Report. You can read it now for no charge. The report surveys over 1,400 industry leaders and dives deep into the current state of digital commerce. Most importantly, it reveals insights on what the leading companies have done right. After reading the report, you’ll likely see the value of investing in a solution like Digital 360 from Salesforce. It unifies all your customer data to create the kind of experiences people are really looking for today. We hope you find the report valuable. Of course, we’d be happy to discuss it with you in detail and answer any questions.',
                    'Digital transformation is happening faster than anyone could have expected, with customer expectations shifting just as quickly. That’s why our partners at Salesforce have created a State of Commerce Report – and you can read it now, for no charge. The report surveys over 1,400 industry leaders and dives deep into the current state of digital commerce. Most importantly, it reveals insights on what the leading companies have been doing right. After reading the report, you’ll likely see the value of investing in a solution like Digital 360 from Salesforce. It unifies all your customer data to create the kind of experiences people are really looking for today. We hope you find the report valuable. Of course, we’d be happy to discuss it with you in detail and answer any questions.',
                    'The evolution of business continues to change before our eyes, which means it’s more important than ever to keep up with current trends of consumer buying behavior, especially when it comes to your industry. Check out our State of Commerce Report for the most up-to-date statistics and stories on what\'s driving direct-to-consumer (DTC) commerce. Plus, you’ll be able to see the buying behavior of today’s consumers in your industry. It\'s 100% free and always available at your leisure. With over 1,400 leading business executives offering their opinions of today’s digital marketplace, you now have the opportunity to gain valuable insights on what will work for your business. Many leading executives have found that their current digital strategies just aren\'t conducive for effective growth, and they even have a hard time keeping up with their customers’ basic needs. Simply click below to read our State of Commerce Report, and start connecting with customers at the next level.',
                ],
                'email_cta' => [
                    'Read the Report',
                    'See the State of Commerce',
                    'View the Report',
                ],

            ],

            'tp3' => [
                'enabled' => true,
                'pages' => ['banner', 'sm', 'landing', 'email', ],
                'title' => 'How',
                'short_title' => 'How',
                'long_title' => '"How" Touchpoint',
                'banner_cta' => [
                    'See our success story',
                    'See how they did it',
                    'See Digital 360 in action',
                    'See how we helped others',
                ],
                'sm_cta' => [
                    'Get the details',
                    'Learn how',
                    'Learn more',
                ],
                'landing_subhead' => [
                    'See just how much more.',
                    'Let’s talk about who’s done transformation right.',
                    'Learn how to deliver happiness at scale.',
                ],
                'landing_intro' => [
                    'Read what the pros are saying.',
                    'These leaders didn’t get there by accident.',
                    'Read a success story from an industry leader.',
                ],
                'landing_body' => [
                    'Salesforce designed Digital 360 as the new standard for what online consumers have come to expect. By combining an entire organization’s data across all platforms, businesses are able to increase sales and engage with customers on levels they never thought possible. See how transforming into Digital 360 has helped these businesses in particular, and find out what it can mean for you.',
                    'See what worked for them, and what can work for you. Check out our Customer Success Stories and see exactly how transforming into Digital 360 has already helped thousands of businesses. Read the success stories of how these businesses were able communicate and engage with their customers by using today’s technology at its full potential. See what Digital 360 did for them, and more importantly, what it can do for you.',
                    'Learn how [PARTNER] has used Digital 360 from Salesforce to bring together data from across their organization and create a customer experience that helped deliver <BUSINESS OUTCOME>. Read their success story.',
                ],
                'landing_cta' => [
                    'Read success stories',
                    'Read their success story',
                ],

                'email_intro' => [
                    'Let’s talk about who’s done transformation right.',
                    'Learn how to deliver customer happiness at scale.',
                    'See just how much more.',
                ],
                'email_body' => [
                    'The pace of change has been unprecedented. It’s been hard to keep up with rapidly evolving customer expectations. If you’re thinking about which moves to make next, we’d like to share some ideas and inspiration with a case study. If you’re looking for a way to create better experiences that put your customers at the heart of everything you do, then let’s talk about Digital 360.',
                    'The pace of change has been unprecedented. It’s been hard to keep up with rapidly evolving customer expectations. If you’re thinking about which moves to make next, we’d like to share some ideas and inspiration with a case study about <INSERT COMPANY NAME>. By using the tools in Digital 360 from Salesforce, they were able to <INSERT ACHIEVEMENT, Example: rapidly shift their business to more online sales and grow their customer base by 25%.> If you’re looking for a way to create better experiences that put your customers at the heart of everything you do, let’s talk about Digital 360.',
                    'Today’s technology is evolving faster than ever, and it may be overwhelming for business leaders to keep up at times. It’s important to stay up-to-date with current consumer trends in your industry, and it’s safe to say the top businesses are moving toward Digital 360 from Salesforce. For example, take a look at <COMPANY>, who began using Digital 360 in <MONTH> of <YEAR>. <COMPANY> is an excellent example of showcasing the power behind our cloud-based marketing service—they were able to effectively increase their sales by XX% in a just matter of months, and their customer satisfaction rates skyrocketed a whopping XX% approval rating. That’s impressive. And if it worked for them, it can work for you too. Check out the rest of their success story and see what Digital 360 can do for you.',
                ],
                'email_cta' => [
                    'Read the Success Story',
                    'See their Success Story',
                    'Explore their Success',
                ],
            ],

            'tp4' => [
                'enabled' => true,
                'pages' => ['banner', 'sm', 'landing', 'email', ],
                'title' => 'Consultation',
                'short_title' => 'Consult',
                'long_title' => '"Consultation" Touchpoint',

                'banner_cta' => [
                    'Request a consultation',
                    'Get started with us now',
                    'Schedule a consultation',
                    'Consult an expert',
                ],
                'sm_cta' => [
                    'Request a consultation',
                    'Schedule a consultation',
                    'Consult an expert',
                ],
                'landing_subhead' => [
                    'Make your next best move.',
                    'Let’s get you to where you want to be.',
                    'Transformation starts here.',
                ],
                'landing_intro' => [
                    'We’re calling on you to call us.',
                    'Transformation starts here.',
                    'Schedule your Digital 360 consultation.',
                ],
                'landing_body' => [
                    'Make the industry standard your new standard by using Digital 360 to engage and communicate with your customers on the same level as Fortune 500 companies. Schedule a call today with one of our experts to find out exactly how we can make your business compete at the next level.',
                    'Data on demand with you in command. Let our experts help you use data to your advantage using Digital 360. Schedule a call today, and let’s take your business to the next level.',
                    'Digital transformation is happening faster than anyone could have expected, with customer expectations shifting just as quickly. Let us show you how Digital 360 from Salesforce can connect all your data – across teams, devices and systems – so that you can create the kind of experiences that delight customers.',
                ],
                'landing_cta' => [
                    'Request a consultation',
                    'Schedule a call',
                    'Schedule a consultation',
                    'Schedule a time',
                ],

                'email_intro' => [
                    'Get you to where you want to be right now.',
                    'Are you ready to start your next transformation?',
                    'Make the industry standard your new standard.',
                ],
                'email_body' => [
                    'The pace of digital transformation has changed virtually every business and make us look hard at the way we do things. Are you one of the fortunate ones who only needs to make a few tweaks to optimize your operation? Or are you looking at rethinking the entire way you engage with customers? Maybe you’re somewhere in between. Wherever you find yourself, Digital 360 from Salesforce can be a huge help by letting you connect all your data – across teams, devices and systems – so you can put your customers at the heart of everything you do. Let’s talk about how to achieve your digital transformation goals during a consultation.',
                    'Over the past year, most business have taken a hard look at what they’re doing in the digital space. Are you one of the fortunate ones who only needs to make a few tweaks to optimize your operation? Or are you looking at rethinking the entire way you engage with customers? Maybe you’re somewhere in between. Wherever you find yourself, Digital 360 from Salesforce can be a huge help by letting you connect all your data – across teams, devices and systems – so you can put your customers at the heart of everything you do. Let’s talk about how to achieve your digital transformation goals during a consultation.',
                    'It’s hard to believe that we’re already rapidly approaching the end of <INSERT DATE Q1 2021>, while digital commerce and communication are drastically changing the way we do business online. As you know, D360 is now the norm for customers, even if they don\'t know it yet. In order to compete in today’s online marketplace, Digital 360 from Salesforce has become essential for growth because most consumers have come to expect the kind of quality this service offers. By taking advantage of cloud-based software, you’ll be able to set up shop on the same playing field that today’s top companies are currently competing on. Ready to make the leap into the pro leagues? Schedule a call with one of our experts to find out exactly how we can make your business better with Digital 360.',
                ],
                'email_cta' => [
                    'Request a Consultation',
                    'Schedule a Consultation',
                    'Schedule a Call',
                ],

            ],
        ],

        'clouds' => [
            'inform' => [
                'title' => 'Inform',
                'description' => 'Drive awareness of your company and services to new and potential customers.',
                'tp1' => [
                    'banner_subhead' => [
                        'Make every touchpoint a great customer experience.',
                        'Digital transformation? You got this.',
                        'Accelerate transformation, reduce confusion.',
                        'Marketing that puts customers at the center of every transaction.',
                        'Intelligence that brings marketers and customers closer together.',
                    ],
                    'sm_subhead' => [
                        'Make every touchpoint a great customer experience.',
                        'Digital transformation? You got this.',
                        'Accelerate transformation, reduce confusion.',
                        'Marketing that puts customers at the center of every transaction.',
                        'Intelligence that brings marketers and customers closer together.',
                    ],
                ],

                'tp2' => [
                    'banner_subhead' => [
                        'Better experiences, stronger relationships.',
                        'Think globally. Target specifically.',
                        'Learn how market leaders thrive—today, tomorrow, and beyond.',
                    ],
                    'sm_subhead' => [
                        'Think globally. Target specifically.',
                        'Understanding where you are is the first step towards digital change.',
                    ],
                ],

                'tp3' => [
                    'banner_subhead' => [
                        'Learn from the leaders in the industry.',
                        'See what top performers are doing right.',
                        'See how much more.',
                        'Read what the pros are saying.',
                    ],
                    'sm_subhead' => [
                        'See how much more.',
                        'Find out why the leaders didn’t get there by accident.',
                        'Making the most of Digital 360 – our client success story.',
                    ],
                ],

                'tp4' => [
                    'banner_subhead' => [
                        'We help get you to where you want to be.',
                        'Information to power your transformation.',
                        'Cloud-based engagement with targeted placement.',
                        'The industry standard should be your new standard.',
                    ],
                    'sm_subhead' => [
                        'Transformation starts here.',
                        'Digital 360—speed, agility, and scale for every market.',
                    ],
                ],
            ],

            'connect' => [
                'title' => 'Connect',
                'description' => 'Focus on ways your company can help customers connect with their clients.',
                'tp1' => [
                    'banner_subhead' => [
                        'Be where your customers are now.',
                        'Meet your customers on their own turf.',
                        'Make every touchpoint a great customer experience.',
                        'Make happier customers, everywhere.',
                        'Create more “WOW” moments for your customers.',
                    ],
                    'sm_subhead' => [
                        'Create more “WOW!” moments for your customers.',
                        'Better experiences, stronger relationships.',
                        'Create opportunities with the power and scope of Digital 360.',
                    ],
                ],
                'tp2' => [
                    'banner_subhead' => [
                        'More connection, less complication.',
                        'Turn customer data into customer love.',
                        'See the world like your customers do.',
                        'Turn today’s data into tomorrow’s happy customers.',
                    ],
                    'sm_subhead' => [
                        'More connection, less complication.',
                        'Valuable insights on how to meet the needs of today’s consumer.',
                        'Make sure you’re living in the same world as your customers.',
                        "Learn more about where your customers are.\r\n(Hint: they’re everywhere)",
                    ],
                ],
                'tp3' => [
                    'banner_subhead' => [
                        'More satisfaction, less distraction.',
                        'Deliver happiness at scale.',
                        'See who’s done transformation right.',
                    ],
                    'sm_subhead' => [
                        'Deliver happiness at scale.',
                        'Let’s talk about who’s done transformation right.',
                        'Learn how our clients meets their customers - wherever they are.',
                    ],
                ],
                'tp4' => [
                    'banner_subhead' => [
                        'Consult with us, connect with your customers.',
                        'Let’s take the complication out of transformation.',
                        'Let’s make life better for your customers.',
                        'We’re ready to answer your big questions.',
                    ],
                    'sm_subhead' => [
                        'Unlock your customers’ potential with Digital 360.',
                        'Learn how integrated technology can create individualized experiences.',
                    ],
                ],
            ],
            'empower' => [
                'title' => 'Empower',
                'description' => 'Focus on ways your company can improve processes and data management to make your customers’ employees more productive.',
                'tp1' => [
                    'banner_subhead' => [
                        'Do what you do best, only better.',
                        'Welcome to the mecca of data.',
                        'Don’t just keep pace, set the pace.',
                        'With the right combination of clouds, the sky’s the limit.',
                    ],
                    'sm_subhead' => [
                        'Do what you do best, only better.',
                        'Keep your data in full focus.',
                    ],
                ],
                'tp2' => [
                    'banner_subhead' => [
                        'Start competing at the next level.',
                        'Exceed your clients’ expectations.',
                        'More knowledge. More engagement. More action.',
                    ],
                    'sm_subhead' => [
                        'More knowledge. More engagement. More action.',
                        'See how leaders have kept up with – and even exceeded – customer expectations in rapidly changing times.',
                    ],
                ],
                'tp3' => [
                    'banner_subhead' => [
                        'Get your data working harder for you.',
                        'The secrets of industry leaders can be yours.',
                        'Know more. Do more. Be more with Digital 360.',
                    ],
                    'sm_subhead' => [
                        'Get your data working harder for you.',
                        'Start competing at the next level.',
                        'The secrets of industry leaders can be yours.',
                    ],
                ],
                'tp4' => [
                    'banner_subhead' => [
                        'More “Wow!” less “How?”',
                        'We make digital transformation look easy.',
                        'Your next best move.',
                        'Data on demand. You in command.',
                    ],
                    'sm_subhead' => [
                        'Make the industry standard your new standard.',
                        'More “Wow!” less “How?',
                    ],
                ],
            ],
        ],


        'questions' => [
            'enabled' => true,

            'categories' => [
                'customer_success' => [
                    [
                        'question' => 'Please identify a customer who has given permission for you to talk about their Digital 360 experience. What makes this customer\'s experience unique?',
                        'placeholder' => 'Please mention your chosen client and a brief description.',
                    ],
                    [
                        'question' => 'What was successful about this client in the Digital 360 software package?',
                        'placeholder' => 'Please speak to your client\'s specific statistics and circumstances leading to its success.',
                    ],
                    [
                        'question' => 'Which clouds did you implement (Marketing/Commerce/Experience) and in what combination?',
                        'placeholder' => 'Please speak to which clouds were used and how.',
                    ],
                    [
                        'question' => 'Why is the customer happy about this?',
                        'placeholder' => 'Please speak to your client’s results and include a quote if possible.',
                    ],
                    [
                        'question' => 'Why is this implementation and client important to you?',
                        'placeholder' => 'Please give a broad answer to this question and make it relatable to how all clients are equally important. This is a good place to also mention how Digital 360 is customer-obsessed.',
                    ],
                    [
                        'question' => 'What are the success metrics for this project?',
                        'placeholder' => 'Please provide specific statistics from this client.',
                    ],
                ],

                'ask_the_expert' => [
                    [
                        'question' => 'What impressed you the most in the State of Commerce Report?',
                        'placeholder' => 'Please speak to digital surges skyrocketing to 200% over one year.',
                    ],
                    [
                        'question' => 'How has the report changed/helped your digital transformation strategy?',
                        'placeholder' => 'Please speak to how the report reassures your strategic decisions because it proves your strategy is also working on a larger scale.',
                    ],
                    [
                        'question' => 'How would you describe the differences between yesterday’s and today’s digital-first consumers?',
                        'placeholder' => 'Please speak to how digital commerce has changed the role of sales in the last year.',
                    ],
                    [
                        'question' => 'What changes in ecommerce do you predict for a post-pandemic, post-cookies world?',
                        'placeholder' => 'Please speak to the effects of the pandemic on consumer behavior and the stats that point to many/most customers wanting to continue shopping solely online. Also, mention your predictions for how companies will have to adapt sans cookies.',
                    ],
                    [
                        'question' => 'What are the biggest opportunities for digital-savvy companies right now?',
                        'placeholder' => 'Please provide specific examples from your client who adapted and excelled from a digital transformation, and how it’s still not too late for other businesses to adapt.',
                    ],
                ],
            ],
        ],

    ];
}
