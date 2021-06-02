<?php

namespace App\Http\Controllers;

use App\utils\Pmc\Assets\Contracts\LayoutContract;
use App\utils\Pmc\Assets\HeadlineParser;
use App\utils\Pmc\Assets\LayoutsManager;
use App\utils\Pmc\AssetsManager;
use App\utils\Pmc\AssetsProcessor;
use App\utils\Pmc\PmcForm;
use Illuminate\Http\Request;

class AssetsController extends Controller
{

    public function layoutsJson() {
        return response()->json(LayoutsManager::instance()->getLayoutsList()->map(function($x) {
            /**
             * @var LayoutContract $x
             */
            return [
                'code' => $x->getCode(),
                'featured_url' => $x->getFeaturedImage()->getUrl(),
                'color_changeable' => $x->isColorChangeable(),
                'has_overlay' => $x->hasOverlay(),
                'default_color' => $x->getDefaultColor(),
            ];
        }));
    }

    public function layoutImageInfoJson($code, $imageCode) {
        $layout = LayoutsManager::instance()->getLayout($code);
        if(!$layout) abort(404);

        $image = $layout->image($imageCode);
        if(!$image) abort(404);

        $info = [
            'code' => $layout->getCode(),
            'featured_url' => $layout->getFeaturedImage()->getUrl(),
            'color_changeable' => $layout->isColorChangeable(),
            'has_overlay' => $layout->hasOverlay(),
            'default_color' => $layout->getDefaultColor(),
            'base_color' => $image->GetBaseColor(),
            'empty_public_id' => $image->GetEmptyPublicId(),
            'empty_image' => $image->GetEmptyUrl(),
        ];

        $info = array_merge($info, $image->params());

        return response()->json($info);
    }


    public function layoutTemplateInfoJson($code, $templateCode) {
        $layout = LayoutsManager::instance()->getLayout($code);
        if(!$layout) abort(404);

        $template = $layout->template($templateCode);
        if(!$template) abort(404);

        $info = [
            'code' => $layout->getCode(),
            'featured_url' => $layout->getFeaturedImage()->getUrl(),
            'color_changeable' => $layout->isColorChangeable(),
            'has_overlay' => $layout->hasOverlay(),
            'default_color' => $layout->getDefaultColor(),

//            'preview_html' => $template->getPreviewHtml(),
//            'base_color' => $image->GetBaseColor(),
//            'empty_public_id' => $image->GetEmptyPublicId(),
//            'empty_image' => $image->GetEmptyUrl(),
        ];

//        $info = array_merge($info, $image->params());

        return response()->json($info);
    }




    public function ActiveAssetsJson() {
        return response()->json(AssetsManager::instance()->ActiveListJson());
    }

    /**
     * @var PmcForm|null
     */
    private $currentPmc = null;

    public function fullCopiesJson(Request $request) {

        $this->currentPmc = PmcForm::FromShortHash($request->hash);

        $ctaList = [
            'Register',
            'Connect',
            'Learn More',
            'Find Out How',
            'Explore What\'s Possible',
            'Start Your Journey',
            'Empower Your Team',
            'Forge Your Path',
            'Accelerate Your Business',
            'Start Now',
            'How can we help?',
        ];


        $lCtaList = [
            'Submit my information',
        ];

        $cloudsRaw = [
            'analytics' => [
                'title' => 'Analytics Cloud',
                'banner_headline' => [
                    'Complex Questions. [SECONDARY]Simple Answers.',
                    'Take Action [SECONDARY]Confidently.',
                    'Instant [SECONDARY]Answers',
                    'Improve any Business Outcome.',
                    'Make better, [SECONDARY]faster decisions.',
                    'Intelligent experiences with cutting-edge augmentation.',
                    'Get answers [SECONDARY]to tough questions.',
                    'Improve operational [SECONDARY]efficiency.',
                    'Your data has a story. [SECONDARY]Do you know it?',
                    'Dirty data? [SECONDARY]We help you clean and connect it.',
                ],
                'banner_body' => [
                    'We can help you use Salesforce to make the right decision every time.',
                    'We can help you discover the story your data has to tell.',
                    'We help you go beyond business intelligence software.',
                    'Let our expertise bring you precise recommendations and specific guidance.',
                ],
                'sm_headline' => [
                    'Complex Questions. Simple Answers.',
                    'Take Action Confidently.',
                    'Go Beyond Business Intelligence Software',
                    'Improve any Business Outcome',
                    'Make better, faster decisions.',
                    'Intelligent experiences. Cutting-edge augmentation.',
                    'Tough Questions? Smart Answers.',
                    'Improve Operational Efficiency',
                    'Discover Your Data\'s Story.',
                    'Be Sure Your Data is Clean and Connected.',
                ],
                'sm_body' => [
                    'Get the most relevant and reliable insights when [PARTNER] connects all your data through Analytics Cloud. AI-driven analysis of millions of data combinations drive decision making through predictions and next-step recommendations for every business user in every role.',
                    'With [PARTNER]\'s help, Analytics Cloud will give you the insights and predictions that will allow you to always know the specific steps to take next. We take complicated marketing data and transform it into optimized and personalized outreach for your customers.',
                    '[PARTNER] can empower you to improve any business outcome with precise recommendations and specific guidance by giving you the exact information you need through tailored analytics using Analytics Cloud.',
                    'Engage, collaborate, and act on real-time predictions, recommendations, and more -- All using transparent, no-code AI powered apps. We can configure Salesforce Analytics Cloud to help you get to better business outcomes.',
                    'With [PARTNER]\'s Analytics Cloud configuration, you will be creating intelligent experiences for your entire team using cutting-edge augmented analytics and AI-powered apps from scratch, or with prebuilt templates, in no time at all.',
                    'Get [PARTNER]\'s data management tools that connect and clean the various types of data you have, regardless of the source. With out-of-the-box connectors, visual data prep, and a scalable, built-in data mart, our Analytics Cloud setup will make it all make sense.',
                    '[PARTNER] can help you take disparate data from any source and get back predictive and prescriptive analytics, narrative explanations, and real-time recommendations from Analytics Cloud.',
                    '[PARTNER] uses Analytics Cloud to bring together data from all your various sources to spot trends, find answers, and create new best practices which will skyrocket your operations to new heights.',
                    'The [PARTNER] team can help you use Analytics Cloud to discover the narrative thread in convoluted data. You\'ll be able to quickly find simple answers to your complex business questions.',
                    '[PARTNER] takes your disparate data from multiple sources and gives you back predictive and prescriptive analytics, narrative explanations, and real-time recommendations from Analytics Cloud.',
                ],

                'landing_subhead' => [
                    'Experience the power of Analytics.',
                    'See how [PARTNER] can make it happen.',
                    'Analytics, tailored to you.',
                    'Bring your business up to speed.',
                    'Be in the know, all the time.',
                    'Put your data to good use with Analytics.',
                    'Go from predictions to manifestations.',
                    'See how [PARTNER] enhances business operations.',
                    'If your data could talk, here\'s what it would say.',
                    'When data is consistent, predictions are more accurate.',
                ],


                'op_headline' => [
                    'Complex Questions. Simple Answers.',
                ],

                'op_subhead' => [
                    'Improve any business outcome with precise recommendations and specific guidance. Get the exact information you need through tailored analytics.',
                ],

                'op_body' => [
                    'Get the most relevant and reliable insights when we connect all your data using world class analytics software.  AI-driven analysis of millions of data combinations drive decision making through predictions and next-step recommendations for every business user in every role.',
                ],

                'op_cta' => [
                    'Discover the story your data has to tell.',
                ],

            ],
            'commerce' => [
                'title' => 'Commerce Cloud',
                'banner_headline' => [
                    'Grow Faster.',
                    'Expand your reach.',
                    'Seamless. Relevant. Connected.',
                    'Blaze new trails.',
                    'Turn customers into repeat customers.',
                    'Deliver more personalized experiences.',
                    'Boost productivity and remove guesswork.',
                ],
                'banner_body' => [
                    'Let [PARTNER] help you not only meet, but exceed your business goals using Commerce Cloud.',
                    '[PARTNER] connects you to customers anytime, anywhere.',
                    '[PARTNER] can help you leverage customer data at any touchpoint using Commerce Cloud.',
                    'Explore [PARTNER]\'s ecommerce research, insights, and best practices.',
                ],
                'sm_headline' => [
                    'Grow Faster.',
                    'Expand Your Reach.',
                    'Seamless. Relevant. Connected.',
                    'Blaze a New Trail.',
                ],
                'sm_body' => [
                    '[PARTNER] can help you not only meet, but exceed your business goals using Commerce Cloud. Artificial Intelligence built for ecommerce transformation raises revenue faster, boosts productivity, and delivers personalized experiences.',
                    '[PARTNER] can help you connect to your customers anywhere, any time with unified, intelligent digital commerce experiences online and in store.',
                    'Let [PARTNER] help you use Commerce Cloud to leverage your customer data at any touchpoint across your digital ecosystem or in store.',
                    '[PARTNER] uses Commerce Cloud to power every interaction with AI and best-in-class apps and tools, design personalized marketing campaigns, boost conversions, and connect shopping experiences to your marketing, sales, and service data.',
                ],

                'landing_subhead' => [
                    'Give your business a boost.',
                    'Connect with your customers anytime, anywhere.',
                    'Leverage your data with ease.',
                    'Bring your digital commerce to the next level.',
                ],

                'op_headline' => [
                    '[PARTNER] expands your reach.',
                ],

                'op_subhead' => [
                    'We can help you not only meet, but exceed your business goals using Commerce Cloud. Artificial Intelligence built for ecommerce transformation can raise revenue faster, boost productivity, and deliver personalized experiences.',
                ],

                'op_body' => [
                    '[PARTNER] can help you use Commerce Cloud to power every interaction with AI and best-in-class apps and tools, to design personalized marketing campaigns, boost conversions, and connect shopping experiences to your marketing, sales, and service data.',
                ],

                'op_cta' => [
                    'Seamless. Relevant. Connected.'
                ],

            ],
            'marketing' => [
                'title' => 'Marketing Cloud',
                'banner_headline' => [
                    'Know Your Customers.',
                    'Anticipate and Deliver.',
                    'Analyze Your Impact.',
                    '[PARTNER] + Marketing Cloud; Realtime Engagement.',
                    'Build your single source of truth.',
                    'Send the right message at the right moment.',
                    'Optimize campaign efficiency with [PARTNER].',
                    'Use the perfect ad for the each customer.',
                    'Analyze less and act more.',
                ],
                'banner_body' => [
                    'Let us help you connect data across every channel and device using Salesforce.',
                    'Personalized engagement through data-driven experiences with [PARTNER].',
                    'We can help you use Marketing Cloud to discover deep insights across every channel.',
                    '[PARTNER] helps you act on insights with data-driven, personalized experiences.',
                ],
                'sm_headline' => [
                    'Data: Connected.',
                    'Anticipate. Deliver.',
                    'Understand Your Impact.',
                    'Realtime Engagement.',
                    'Build Your Single Source of Truth.',
                    'Right Message; Right Moment.',
                ],
                'sm_body' => [
                    '[PARTNER] specializes in Marketing Cloud\'s Data Studio, the #1 solution for audience discovery, data acquisition, and data provisioning, with a user-friendly interface that any media planner or analyst can use.',
                    'Let [PARTNER] introduce you to Journey Builder for Marketing Cloud. Create seamless customer experiences across every channel, and continually adjust customers\' paths based on current and predicted behavior. With automated journey logic, you will be prepared for every customer engagement, decision, and random journey split.',
                    '[PARTNER] uses Marketing Cloud to enhance the understanding of your engagements through deep analytics for individual or aggregated data. We can help you deliver simple or complex personalized journeys for every one of your customers.',
                    '[PARTNER]\'s configuration of Datorama for Marketing Cloud connects, analyzes, and allows you to take action on all of your data in a single marketing dashboard. Drive ROI, speed, and growth across the depth and breadth of your business.',
                    '[PARTNER] helps you unify every marketing channel\'s data to build a single profile for each of your customers. This single source of truth will enhance your ability to deliver a personalized experience that only Marketing Cloud can enable.',
                    'Intelligent marketing automation helps you grow relationships and revenue through the delivery of seamless experiences and AI-powered personalization. Let [PARTNER] help you use Marketing Cloud to get to know your customers and engage them in entirely new ways with data-powered, relevant messaging.',
                ],

                'landing_subhead' => [
                    'Marketing: Targeted.',
                    'Adjust your itinerary accordingly.',
                    '[PARTNER] makes it personal.',
                    'Set the pace at any speed.',
                    'Get to know every customer.',
                    'Left with you in charge.',
                ],

                'op_headline' => [
                    'Right Message; Right Moment.',
                ],

                'op_subhead' => [
                    'Intelligent marketing automation helps you grow relationships and revenue through the delivery of seamless experiences and AI-powered personalization. [PARTNER] can help you use Salesforce Marketing Cloud to get to know your customers and engage them in entirely new ways with data-powered, relevant messaging.',
                ],

                'op_body' => [
                    '[PARTNER] can enhance the understanding of your engagements through the use of Marketing Cloud\'s deep analytics for individual or aggregated data. Our team will set you up to deliver simple or complex personalized journeys for every one of your customers.',
                ],

                'op_cta' => [
                    'Build your single source of truth.',
                ],

            ],

            'sales' => [
                'title' => 'Sales Cloud',
                'banner_headline' => [
//                    'Build Stronger Relationships.',
                    'Eliminate Guesswork.',
                    'Maximize your best work.',
                    'Transform the Buying Experience.',
                    'Insightful Decisions. Accelerated productivity.',
                    'Close more deals. Grow sales faster.',
                    'Speed up your sales cycle.',
                    'Pave new paths to revenue growth.',
                    'Details getting lost in the noise? Focus.',
                    'Sales cycle too slow? Accelerate it.',
                ],
                'banner_body' => [
                    'We help you use Sales Cloud to connect to your customers.',
                    'Higher productivity and revenue through data-driven selling.',
                    'Win big, time and time again using Salesforce - We can help.',
                    '[PARTNER] helps you connect with customers and forecast with confidence.',
                ],
                'sm_headline' => [
                    'Build Stronger Relationships.',
                    'Eliminate the Guesswork.',
                    'Win Big, Time and Time Again.',
                    'Transform the Buying Experience.',
                    'Insightful Decisions. Accelerated Productivity.',
                    'Close More Deals. Grow Sales Faster.',
                    'Speed up Your Sales Cycle.',
                    'New Paths to Revenue Growth.',
                    'FOCUS.',
                    'ACCELERATE.',
                ],
                'sm_body' => [
                    'Let us connect your sales team to marketing, service, commerce and more while we break down silos and unleash the true power of your data using Sales Cloud.',
                    'We use Sales Cloud to give you the power to utilize your data to drive productivity, sales, and revenue with data models and workflows specific to your industry.',
                    'Increase productivity and grow revenue through intelligent, data-driven selling. Our team configures Sales Cloud to connect you to customers and transform their buying experience, giving a faster return on investment regardless of your company size, industry or geography.',
                    'We specialize in Sales Cloud, the #1 growth platform for digital sales teams. We can cofigure Sales Cloud to help you connect and integrate your customer data to create a single source of truth, which will empower you to close deals fast, scale your business, and strengthen every customer relationship.',
                    'Identify market shifts quickly and adapt your processes with ease. Forecast sales with more precision, and drive more predictable revenue. We can set you up to utilize Sales Cloud to keep your sales teams informed and agile.',
                    'Maximize revenue and take friction out of the buying process for your customers. With our installation of Sales Cloud, you will be able to utilize data models and workflows specific to your industry to forge new, faster paths to revenue growth.',
                    'With better market data, accurate forecasts, and efficient processes, you\'ll see unbeatable revenue growth, and your sales teams will be set up for repeated success. We will gives your company the tools you need for growth and speed in an ever changing market landscape with Sales Cloud.',
                    'With [PARTNER] and Sales Cloud, there\'s no more guesswork. Travel the road to revenue growth with confidence thanks to a complete view of your business through unified data from every source on a single platform.',
                    'With [PARTNER} and Sales Cloud, we put all your pipeline data in a single place, allowing you to identify gaps in processes, focus your sales reps, and forecast your sales using an intuitive AI.',
                    'Using Sales Cloud, [PARTNER] will help you traverse new frontiers in account, contact, opportunity, and lead management through intelligent, data-driven selling that will increase your team\'s skills, strengthen your processes, and speed up your revenue pipeline.',
                ],

                'landing_subhead' => [
                    'Integration means expansion.',
                    'Increase your impact.',
                    'Stack the odds in your favor.',
                    'Keep your customers coming back.',
                    'Make more precise preditctions.',
                    'Transition your transactions.',
                    'Accelerate your sales.',
                    'Unified data. Justified results.',
                    'View your business through a more powerful lens.',
                    'The fast track of new digital frontiers.',
                ],

                'op_headline' => [
                    'Eliminate the Guesswork -- [PARTNER]',
                ],

                'op_subhead' => [
                    '[PARTNER] helps configure Sales Cloud to give you the power to utilize your data to drive productivity, sales, and revenue with data models and workflows specific to your industry.',
                ],

                'op_body' => [
                    'Increase productivity and grow revenue through intelligent, data-driven selling. Our team will help you use Sales Cloud to connect to customers and transform their buying experience, giving a faster return on investment regardless of your company size, industry or geography.',
                ],

                'op_cta' => [
                    'Transform your customers\' buying experience.',
                ],
            ],


            'service' => [
                'title' => 'Service Cloud',
                'banner_headline' => [
                    'Deliver Support in Realtime.',
                    '[PARTNER] + Service Cloud - Work Smarter.',
                    'Happy Teams Make Happy Customers.',
                    'Unified Data.',
                    'Self-service at scale. Anytime. Anywhere.',
                    'Deliver great service from anywhere.',
                    '[PARTNER] streamlines knowledge management with Service Cloud.',
                    'Amplify agent efficiency.',
                    'Want happier customers? Deliver smarter.',
                    'Demand spikes causing outages? Scale smarter.',
                ],
                'banner_body' => [
                    'With our help, you can empower your customers with support any time on any channel using Salesforce.',
                    'Customer, digital, and field service: CONNECTED',
                    'We make employee service work better using Salesforce.',
                    'Let us bring you a single view of every employee using Service Cloud.',
                ],
                'sm_headline' => [
                    'Deliver Support in Realtime.',
                    'Work Smarter.',
                    'Happy Teams Make Happy Customers.',
                    'Unify Your Data.',
                    'Self-service at Scale. Anytime. Anywhere.',
                    'Deliver Great Service from Anywhere.',
                    'Streamline Your Knowledge Management.',
                    'Amplify Agent Efficiency.',
                    'Deliver Smarter.',
                    'Scale Smarter.',
                ],
                'sm_body' => [
                    'Give your support agents the tools they need to deliver an exceptional customer service experience anytime, from anywhere. The [PARTNER] Service Cloud installation is the world\'s most trusted, agile, and innovative platform.',
                    '[PARTNER] uses Service Cloud\'s Einstein AI to give your service reps the information they need through automated data collection bots, seamless agent handoffs, and AI analysis for advanced case prediction triage.',
                    'Empower your employees with a state-of-the-art self-service portal. [PARTNER] helps you use Service Cloud to not only bring benefits to your customers, but enhance your employee engagement, freeing them up to focus on the tasks at hand.',
                    'Utilize supercharged AI to power Omni-Channel case routing, not only bringing all pertinent data directly to your service agents, but also making sure cases are routed to the right agent based on their skillset and availability. [PARTNER] can make this happen for you using Service Cloud.',
                    'Empower your customers with the ability to find critical answers fast, using the channels they are most comfortable with. [PARTNER] connects your customers to everything from account information to knowledge bases to agents with the skills to help resolve their problems, all with Service Cloud.',
                    'When [PARTNER] configures Service Cloud for you, field service optimization, live chat, and mobile messaging tools increase your team\'s online and offline productivity while also helping your customers find answers on their own and from each other through a self-service community.',
                    'Embedded knowledge articles and access to important data will free up your agents from having to handle common questions and requests. [PARTNER] can help you simplify self-service through Service Cloud\'s creation of step-by-step processes and end-to-end workflows.',
                    'Let [PARTNER] help you configure Sales Cloud\'s agent workspace and allow your service agents to seamlessly handle cases from one screen via an easy-to-use service console complete with built-in productivity tools, and a 306-degree view of every customer.',
                    'When [PARTNER] helps you set up service process automation using Service Cloud, you can create end-to-end workflows which automate and scale repetitive business processes with drag-and-drop simplicity.',
                    'Let [PARTNER] help you enable intelligent, satisfying self-service, AI-powered contextual recommendations and predictions, and intelligent chatbots across your digital channels, with Einstein for Service built into Salesforce Service Cloud.',
                ],

                'landing_subhead' => [
                    'Connect and engage with your customers.',
                    'Add AI to your team.',
                    'Keep everyone on cloud nine.',
                    'The right place at the right time.',
                    'Frequent answers to their FAQs.',
                    'Be accessible, even when you\'re not.',
                    'Self-service, simplified.',
                    'The tools you need for your agents to succeed.',
                    'Keep the workflow flowing smoothly.',
                    'Provide better.',
                ],

                'op_headline' => [
                    'Deliver Great Service from Anywhere.',
                ],

                'op_subhead' => [
                    'Give your support agents the tools they need to deliver an exceptional customer service experience anytime, from anywhere. A [PARTNER] Service Cloud installation is built on Salesforce\'s best-in-class trusted, agile, and innovative platform.',
                ],

                'op_body' => [
                    'When [PARTNER] configures Service Cloud for you, field service optimization, live chat, and mobile messaging tools increase your online and offline productivity while also helping your customers find answers on their own and from each other through a self-service community.',
                ],

                'op_cta' => [
                    'Service at Scale. Anytime. Anywhere.',
                ],

            ],
        ];

        $clouds = array_map(function($cloud) {
            $cloud['banner_headline'] = array_map([$this, '_analyzeHeadLine'], $cloud['banner_headline']);
            $cloud['sm_headline'] = array_map([$this, '_analyzeHeadLine'], $cloud['sm_headline']);

            $cloud['banner_body'] = array_map([$this, '_analyzeBody'], $cloud['banner_body']);
            $cloud['sm_body'] = array_map([$this, '_analyzeBody'], $cloud['sm_body']);

            $cloud['landing_subhead'] = array_map([$this, '_analyzeBody'], $cloud['landing_subhead']);
            $cloud['op_headline'] = array_map([$this, '_analyzeBody'], $cloud['op_headline']);
            $cloud['op_subhead'] = array_map([$this, '_analyzeBody'], $cloud['op_subhead']);
            $cloud['op_body'] = array_map([$this, '_analyzeBody'], $cloud['op_body']);
            $cloud['op_cta'] = array_map([$this, '_analyzeBody'], $cloud['op_cta']);

            return $cloud;
        }, $cloudsRaw);

        return response()->json([
            'cta' => $ctaList,
            'lCta' => $lCtaList,
            'clouds' => $clouds,
        ]);
    }



    public function fullCibCopiesJson(Request $request) {
        $this->currentPmc = PmcForm::FromShortHash($request->hash);

        ['setup' => $setup, 'common' => $common, 'clouds' => $clouds, 'questions' => $questions] = instance()->Cib()->Copies();

//        $clouds = array_map(function($cloud) {
//            $cloud['banner_headline'] = array_map([$this, '_analyzeHeadLine'], $cloud['banner_headline']);
//            $cloud['sm_headline'] = array_map([$this, '_analyzeHeadLine'], $cloud['sm_headline']);
//
//            $cloud['banner_body'] = array_map([$this, '_analyzeBody'], $cloud['banner_body']);
//            $cloud['sm_body'] = array_map([$this, '_analyzeBody'], $cloud['sm_body']);
//
//            $cloud['landing_subhead'] = array_map([$this, '_analyzeBody'], $cloud['landing_subhead']);
//            $cloud['op_headline'] = array_map([$this, '_analyzeBody'], $cloud['op_headline']);
//            $cloud['op_subhead'] = array_map([$this, '_analyzeBody'], $cloud['op_subhead']);
//            $cloud['op_body'] = array_map([$this, '_analyzeBody'], $cloud['op_body']);
//            $cloud['op_cta'] = array_map([$this, '_analyzeBody'], $cloud['op_cta']);
//
//            return $cloud;
//        }, $cloudsRaw);



        $common = array_map(function($x) {
            $x['landing_body'] = array_map([$this, '_analyzeBody'], $x['landing_body']);
            return $x;
        }, $common);

        return response()->json([
            'setup' => $setup,
            'common' => $common,
            'clouds' => $clouds,
            'questions' => $questions,
        ]);

    }




    private function _analyzeBody($input) {
        $input = $this->_substitutePartner($input);
        return $input;
    }

    private function _substitutePartner(string $input): string {
        if($this->currentPmc) {
            if($c = $this->currentPmc->GetModel()->company) {
                $input = str_replace('[PARTNER]', $c, $input);
            }
        }
        return $input;
    }

    private function _analyzeHeadLine($input) {
        $input = $this->_substitutePartner($input);
        return HeadlineParser::Parse($input);
    }


    public function extraData($hash) {
        $pmc = null;
        try {
            $pmc = PmcForm::FromShortHash($hash);
        } catch (\Exception $e) {

        }

        if(!$pmc) abort(404);

        $m = $pmc->GetModel();

        $emailAddressLine = "{$m->company} {$m->address}, {$m->city}, {$m->state} {$m->zip_code}.";
        if($phone = $m->phone) {
            $emailAddressLine .= " Tel {$m->phone}";
        }

        return response()->json([
            'emailAddressLine' => $emailAddressLine,
        ]);
    }

    public function test2($hash) {

        $pmc = PmcForm::FromHash($hash);

        $processor = new AssetsProcessor();
        $layout = LayoutsManager::instance()->getLayout($pmc->GetModel()->customCreative->layout_code);

        return view('test')->with([
//            'largeRectangle' => $processor->ProcessImage($layout, $layout->image('large_rectangle'), $pmc),
//            'leaderBoard' => $processor->ProcessImage($layout, $layout->image('leader_board'), $pmc),
//            'mobile' => $processor->ProcessImage($layout, $layout->image('mobile'), $pmc),
//            'skyScrapper' => $processor->ProcessImage($layout, $layout->image('sky_scrapper'), $pmc),
//            'mediumRectangle' => $processor->ProcessImage($layout, $layout->image('medium_rectangle'), $pmc),

            'facebook' => $processor->ProcessImage($layout, $layout->image('facebook'), $pmc),
            'instagram' => $processor->ProcessImage($layout, $layout->image('instagram'), $pmc),
            'twitter' => $processor->ProcessImage($layout, $layout->image('twitter'), $pmc),
            'linkedin' => $processor->ProcessImage($layout, $layout->image('linkedin'), $pmc),
        ]);

    }

}
