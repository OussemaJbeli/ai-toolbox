<?php

namespace Database\Seeders;

use App\Models\Carrency;
use App\Models\Icons;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //admin
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '123456789',
            'avatar'=>'icon/sid_bar/avatar/avatar1.png',
            'sid_img'=> 'icon/sid_bar/wallpapers/img_1.jpg',
            'filter'=>'#ffc502',
            'darkMode'=>true,
            'answered'=>true,
            'admin'=>true,
            'super_user'=>true,
            'special_user'=>true,
            'payment'=>true,
        ]);

        //tool categories
        $categories = [
            ['name'=>'Text Generator',
            'description'=>'intelligent Writing assistant',
            'logo'=>'<i class="fa-solid fa-file-lines"></i>',
            'color'=>'#e1dbff',
            'theme'=>'#8b59ff',],

            ['name'=>'Image Generator',
            'description'=>'Create eye-catching images and graphics.',
            'logo'=>'<i class="fa-regular fa-image"></i>',
            'color'=>'#8b59ff',
            'theme'=>'#e1dbff',],

            ['name'=>'Code Generator',
            'description'=>'Generate high quality code in no time.',
            'logo'=>'<i class="fa-solid fa-code"></i>',
            'color'=>'#598bff',
            'theme'=>'#dbe3ff',],

            ['name'=>'Chat Bot',
            'description'=>'Meet your next virtual assistant.',
            'logo'=>'<i class="fa-solid fa-comment-dots"></i>',
            'color'=>'#13e5e9',
            'theme'=>'#d3faf7',],

            ['name'=>'Voice Generator',
            'description'=>'Translate your speech into text and vice versa',
            'logo'=>'<i class="fa-solid fa-microphone"></i>',
            'color'=>'#a6f515',
            'theme'=>'#e1f7c4',],
        ];
        foreach ($categories as $categorie) {
            DB::table('original_categories')->insert([
                'name' => $categorie['name'],
                'description' => $categorie['description'],
                'logo' => $categorie['logo'],
                'color' => $categorie['color'],
                'theme' => $categorie['theme'],
            ]);
        };

        //sub tool categories
        $sub_categories = [
            [
                'id_categorie' => 1,
                'name'=>'Article Generator',
                'description'=>'Turn a title and outline text into a fully complete high quality article within seconds',
                'logo'=>'<i class="fa-solid fa-rectangle-list"></i>',
                'color'=>'#ff5959',
                'theme'=>'#ffcece',],

            [            
                'id_categorie' => 1,
                'name' => 'Ecommerce',
                'description' => 'Powerful tools for e-commerce, listings of your products',
                'logo'=>'<i class="fa-brands fa-amazon"></i>',
                'color'=>'#ff5959',
                'theme'=>'#ffcece',],

            [
                'id_categorie' => 1,
                'name' => 'Emails',
                'description' => 'Creative templates for email creation',
                'logo'=>'<i class="fa-solid fa-envelope-open"></i>',
                'color'=>'#ff5959',
                'theme'=>'#ffcece'],

            [            
                'id_categorie' => 1,
                'name' => 'Frameworks',
                'description' => 'The best marketing copywriting tools',
                'logo'=>'<i class="fa-solid fa-briefcase"></i>',
                'color'=>'#ff5959',
                'theme'=>'#ffcece'],

            [            
                'id_categorie' => 1,
                'name' => 'Marketing',
                'description' => 'Professional PR tools for brand and business',
                'logo'=>'<i class="fa-solid fa-tag"></i>',
                'color'=>'#ff5959',
                'theme'=>'#ffcece'],

            [            
                'id_categorie' => 1,
                'name' => 'Social Media',
                'description' => 'Flash tools for social media content',
                'logo'=>'<i class="fa-brands fa-twitter"></i>',
                'color'=>'#ff5959',
                'theme'=>'#ffcece'],

            [            
                'id_categorie' => 1,
                'name' => 'Websites',
                'description' => 'Useful contents for websites',
                'logo'=>'<i class="fa-solid fa-file-alt"></i>',
                'color'=>'#ff5959',
                'theme'=>'#ffcece'],

            [            
                'id_categorie' => 1,
                'name' => 'Blog Posts',
                'description' => 'Content for the generating articles, blog post',
                'logo'=>'<i class="fa-solid fa-pencil-alt"></i>',
                'color'=>'#ff5959',
                'theme'=>'#ffcece'],
        ];
        foreach ($sub_categories as $categorie) {
            DB::table('sub_categories')->insert([
                'id_categorie' => $categorie['id_categorie'],
                'name' => $categorie['name'],
                'description' => $categorie['description'],
                'logo' => $categorie['logo'],
                'color' => $categorie['color'],
                'theme' => $categorie['theme'],
            ]);
        };

        // tools

        //text
        $tools1 = [
            ['id' => '1', 'name' => 'Pros & Cons', 'description' => 'Write the pros and cons of a product, service, or website for your blog article', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-rectangle-list"></i>', 'prompte' => "I need you to write the pros and cons of a product, service, or website for my blog article."],
            ['id' => '2', 'name' => 'Summarize for 2nd Grader', 'description' => 'Summarize any complex content for a 2nd grader child', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-file-alt"></i>', 'prompte' => "I need you to summarize any complex content for a 2nd grader child."],
            ['id' => '3', 'name' => 'Content Rewriter', 'description' => 'Take a piece of content and rewrite it to make it more interesting, creative, and engaging', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-pencil-alt"></i>', 'prompte' => "I need you to rewrite a piece of content to make it more interesting, creative, and engaging."],
            ['id' => '4', 'name' => 'Paragraph Generator', 'description' => 'Generate paragraphs about any topic including a keyword and in a specific tone of voice', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-align-left"></i>', 'prompte' => "I need you to generate paragraphs about any topic including a keyword and in a specific tone of voice."],
            ['id' => '5', 'name' => 'Talking Points', 'description' => 'Write short, simple, and informative points for the subheadings of your article', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-bullseye"></i>', 'prompte' => "I need you to write short, simple, and informative points for the subheadings of my article."],
            ['id' => '6', 'name' => 'Summarize Text', 'description' => 'Summarize any text in a short and easy-to-understand concise way', 'pro' => true, 'premium' => false, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-solid fa-file-alt"></i>', 'prompte' => "I need you to summarize any text in a short and easy-to-understand concise way."],
            ['id' => '7', 'name' => 'Product Description', 'description' => 'Write the description about your product and why it worth it', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-tag"></i>', 'prompte' => "I need you to write the description about my product and why it's worth it."],
            ['id' => '8', 'name' => 'Startup Name Generator', 'description' => 'Generate cool, creative, and catchy names for your startup in seconds', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-star"></i>', 'prompte' => "I need you to generate cool, creative, and catchy names for my startup in seconds."],
            ['id' => '9', 'name' => 'Product Name Generator', 'description' => 'Create creative product names from examples words', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-tags"></i>', 'prompte' => "I need you to create creative product names from example words."],
            ['id' => '10', 'name' => 'Academic Essay', 'description' => 'Create creative academic essays for various subjects just in a second', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-graduation-cap"></i>', 'prompte' => "I need you to create creative academic essays for various subjects just in a second."],
            ['id' => '11', 'name' => 'Creative Stories', 'description' => 'Allow AI to generate creative stories for you based on input text', 'pro' => true, 'premium' => false, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-solid fa-book"></i>', 'prompte' => "I need AI to generate creative stories for me based on input text."],
            ['id' => '12', 'name' => 'Grammar Checker', 'description' => 'Make sure that there are no errors in your content', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-spell-check"></i>', 'prompte' => "I need you to make sure that there are no errors in my content."],
            ['id' => '13', 'name' => 'Text Extender', 'description' => 'Extend your sentences with more description and additional information', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-text-width"></i>', 'prompte' => "I need you to extend my sentences with more description and additional information."],
            ['id' => '14', 'name' => 'Rewrite with Keywords', 'description' => 'Rewrite your existing content with including specific keywords', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-redo"></i>', 'prompte' => "I need you to rewrite my existing content with including specific keywords."],
            ['id' => '15', 'name' => 'Business Ideas', 'description' => 'Generate business ideas based on your keywords and description', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-lightbulb"></i>', 'prompte' => "I need you to generate business ideas based on my keywords and description."],
            ['id' => '16', 'name' => 'Tone Changer', 'description' => 'Change the tone of your writing to match your audience', 'pro' => false, 'premium' => false, 'Free' => true, 'Standard' => false, 'logo' => '<i class="fa-solid fa-volume-up"></i>', 'prompte' => "I need you to change the tone of my writing to match my audience."],
            ['id' => '17', 'name' => 'Dictionary', 'description' => 'Use a dictionary to find all details of your word', 'pro' => false, 'premium' => false, 'Free' => true, 'Standard' => false, 'logo' => '<i class="fa-solid fa-book-open"></i>', 'prompte' => "I need you to use a dictionary to find all details of my word."],
            ['id' => '18', 'name' => 'Privacy Policy', 'description' => 'Develop a privacy policy information for your organization', 'pro' => true, 'premium' => false, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-solid fa-user-secret"></i>', 'prompte' => "I need you to develop a privacy policy information for my organization."],
            ['id' => '19', 'name' => 'Terms and Conditions', 'description' => 'Develop a terms and conditions information for your organization', 'pro' => true, 'premium' => false, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-solid fa-scroll"></i>', 'prompte' => "I need you to develop a terms and conditions information for my organization."],
        ];
        
        $tools2 = [
            ['id' => '20', 'name' => 'Amazon Product Features', 'description' => 'Advantages and features of your products that will make them irresistible for shoppers', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-amazon"></i>', 'prompte' => "I need you to write about the advantages and features of my products that will make them irresistible for shoppers."],
            ['id' => '21', 'name' => 'Amazon Product Description', 'description' => 'Create attention-grabbing Amazon product description', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-amazon"></i>', 'prompte' => "I need you to create attention-grabbing Amazon product description."],
            ['id' => '22', 'name' => 'Product Benefits', 'description' => 'List out product benefits via help of AI solution', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-check-double"></i>', 'prompte' => "I need you to list out product benefits via help of AI solution."],
            ['id' => '23', 'name' => 'Selling Product Titles', 'description' => 'Find out selling product titles for your product description', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-tag"></i>', 'prompte' => "I need you to find out selling product titles for my product description."],
            ['id' => '24', 'name' => 'Product Comparisons', 'description' => 'Create a comprehensive comparison of two products between each other', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-balance-scale"></i>', 'prompte' => "I need you to create a comprehensive comparison of two products between each other."],
            ['id' => '25', 'name' => 'Product Characteristics', 'description' => 'Write a full product characteristics', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-cogs"></i>', 'prompte' => "I need you to write a full product characteristics."],
        ];
        
        $tools3 = [
            ['id' => '26','name' => 'Welcome Email', 'description' => 'Create welcome emails for your customers', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-envelope-open"></i>', 'prompte' => "I need you to create welcome emails for my customers."],
            ['id' => '27','name' => 'Cold Email', 'description' => 'Create professional cold emails with the help of AI', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-envelope"></i>', 'prompte' => "I need you to create professional cold emails with the help of AI."],
            ['id' => '28','name' => 'Follow-Up Email', 'description' => 'Create professional email follow up with just a few clicks', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-handshake"></i>', 'prompte' => "I need you to create a professional email follow-up with just a few clicks."],
            ['id' => '29','name' => 'Email Subject Lines', 'description' => 'Create professional email subject lines', 'pro' => false, 'premium' => false, 'Free' => true, 'Standard' => false, 'logo' => '<i class="fa-solid fa-at"></i>', 'prompte' => "I need you to create professional email subject lines."],
        ];

        
        $tools4 = [
            ['id' => '30','name' => 'Problem-Agitate-Solution (PAS) Framework', 'description' => 'Generate one of the most effective copywriting formulas for your business', 'pro' => false, 'premium' => true, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-solid fa-briefcase"></i>', 'prompte' => "I need you to generate one of the most effective copywriting formulas for my business."],
            ['id' => '31','name' => 'Before–After–Bridge (BAB) Framework', 'description' => 'Conversion-oriented formula designed to make a particular offer more appealing', 'pro' => false, 'premium' => true, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-solid fa-sync-alt"></i>', 'prompte' => "I need you to create a conversion-oriented formula designed to make a particular offer more appealing."],
            ['id' => '32','name' => 'Attention-interest-Desire-Action (AIDA) Framework', 'description' => 'AIDA model will help you ensure that any kind of writing is as effective as possible', 'pro' => false, 'premium' => true, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-solid fa-bullseye"></i>', 'prompte' => "I need you to use the AIDA model to ensure that any kind of writing is as effective as possible."],
            ['id' => '33','name' => 'Promise–Picture–Proof–Push (PPPP) Framework', 'description' => 'Use 4P formula to craft persuasive content that moves readers to action', 'pro' => false, 'premium' => true, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-solid fa-hand-holding-usd"></i>', 'prompte' => "I need you to use the 4P formula to craft persuasive content that moves readers to action."],
        ];

        
        $tools5 = [
            ['id' => '34','name' => 'Brand Names', 'description' => 'Generate unique brand names with the help of AI', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-tag"></i>', 'prompte' => "I need you to generate unique brand names with the help of AI."],
            ['id' => '35','name' => 'Clickbait Titles', 'description' => 'Create creative clickbait titles for your products', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-mouse-pointer"></i>', 'prompte' => "I need you to create creative clickbait titles for my products."],
            ['id' => '36','name' => 'Company Press Release', 'description' => 'Write a company press release with the help of AI', 'pro' => false, 'premium' => true, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-solid fa-building"></i>', 'prompte' => "I need you to write a company press release with the help of AI."],
            ['id' => '37','name' => 'Brand/Product Press Release', 'description' => 'Write a brand or product press release with the help of AI', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-bullhorn"></i>', 'prompte' => "I need you to write a brand or product press release with the help of AI."],
            ['id' => '38','name' => 'Ad Headlines', 'description' => 'Write an attention-grabbing ad headlines', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-ad"></i>', 'prompte' => "I need you to write attention-grabbing ad headlines."],
        ];
        
        $tools6 = [
            ['id' => '39','name' => 'Twitter Tweets', 'description' => 'Generate interesting Twitter tweets with AI', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-twitter"></i>', 'prompte' => "I need you to generate interesting Twitter tweets with AI."],
            ['id' => '40','name' => 'Facebook Ads', 'description' => 'Write Facebook ads that engage your audience and deliver a high conversion rate', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-facebook"></i>', 'prompte' => "I need you to write Facebook ads that engage my audience and deliver a high conversion rate."],
            ['id' => '41','name' => 'Video Descriptions', 'description' => 'Write compelling YouTube descriptions to get people interested in your video', 'pro' => true, 'premium' => false, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-brands fa-youtube"></i>', 'prompte' => "I need you to write compelling YouTube descriptions to get people interested in my video."],
            ['id' => '42','name' => 'Video Titles', 'description' => "Write a compelling YouTube video title to catch everyone's attention", 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-youtube"></i>', 'prompte' => "I need you to write a compelling YouTube video title to catch everyone's attention."],
            ['id' => '43','name' => 'Youtube Tags Generator', 'description' => 'Generate SEO-optimized YouTube tags / keywords for your video', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-youtube"></i>', 'prompte' => "I need you to generate SEO-optimized YouTube tags / keywords for my video."],
            ['id' => '44','name' => 'instagram Captions', 'description' => 'Grab attention with catchy captions for your instagram posts', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-instagram"></i>', 'prompte' => "I need you to grab attention with catchy captions for my instagram posts."],
            ['id' => '45','name' => 'instagram Hashtags Generator', 'description' => 'Find the best hashtags to use for your instagram posts', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-instagram"></i>', 'prompte' => "I need you to find the best hashtags to use for my instagram posts."],
            ['id' => '46','name' => 'Social Media Post (Personal)', 'description' => 'Write a social media post for yourself to be published on any platform', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-user-circle"></i>', 'prompte' => "I need you to write a social media post for myself to be published on any platform."],
            ['id' => '47','name' => 'Social Media Post (Business)', 'description' => 'Write a post for your business to be published on any social media platform', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-building"></i>', 'prompte' => "I need you to write a post for my business to be published on any social media platform."],
            ['id' => '48','name' => 'Facebook Headlines', 'description' => 'Write catchy and convincing headlines to make your Facebook Ads stand out', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-facebook"></i>', 'prompte' => "I need you to write catchy and convincing headlines to make my Facebook Ads stand out."],
            ['id' => '49','name' => 'Google Ads Headlines', 'description' => 'Write catchy 30-character headlines to promote your product with Google Ads', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-google"></i>', 'prompte' => "I need you to write catchy 30-character headlines to promote my product with Google Ads."],
            ['id' => '50','name' => 'Google Ads Description', 'description' => 'Write a Google Ads description that makes your ad stand out and generates leads', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-google"></i>', 'prompte' => "I need you to write a Google Ads description that makes my ad stand out and generates leads."],
            ['id' => '51','name' => 'Video Scripts', 'description' => 'Quickly create scripts for your videos and start shooting', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-video"></i>', 'prompte' => "I need you to quickly create scripts for my videos and start shooting."],
            ['id' => '52','name' => 'Linkedin Posts', 'description' => 'Create an interesting Linkedin post with the help of AI', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-linkedin"></i>', 'prompte' => "I need you to create an interesting Linkedin post with the help of AI."],
            ['id' => '53','name' => 'TitTok Video Scripts', 'description' => 'Video scripts that are ready to shoot and will make you go viral', 'pro' => true, 'premium' => false, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-brands fa-tiktok"></i>', 'prompte' => "I need you to provide video scripts that are ready to shoot and will make me go viral."],
            ['id' => '54','name' => 'Linkedin Ad Headlines', 'description' => 'Attention-grabbing, click-inducing and high-converting ad headlines for Linkedin', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-linkedin"></i>' , 'prompte'=>'I need you to create Linkedin Ad Headlines'],
            ['id' => '55','name' => 'Linkedin Ad Descriptions', 'description' => 'Professional and eye-catching ad descriptions that will make your product shine', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-brands fa-linkedin"></i>' , 'prompte'=>'I need you to create Linkedin Ad Descriptions'],
        ];
        
        $tools7 = [
            ['id' => '56','name' => 'Meta Description', 'description' => 'Write SEO-optimized meta description based on a description', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-file-alt"></i>', 'prompte' => "I need you to write SEO-optimized meta description based on a description."],
            ['id' => '57','name' => 'FAQs', 'description' => 'Generate frequently asked questions based on your product description', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-question-circle"></i>', 'prompte' => "I need you to generate frequently asked questions based on my product description."],
            ['id' => '58','name' => 'FAQ Answers', 'description' => 'Generate creative answers to questions (FAQs) about your business or website', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-comment"></i>', 'prompte' => "I need you to generate creative answers to questions (FAQs) about my business or website."],
            ['id' => '59','name' => 'Testimonials / Reviews', 'description' => 'Add social proof to your website by generating user testimonials', 'pro' => false, 'premium' => false, 'Free' => true, 'Standard' => false, 'logo' => '<i class="fa-solid fa-star"></i>', 'prompte' => "I need you to add social proof to my website by generating user testimonials."],
            ['id' => '60','name' => 'Song Lyrics', 'description' => 'Generate song lyrics based on your description and keywords', 'pro' => true, 'premium' => false, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-solid fa-music"></i>', 'prompte' => "I need you to generate song lyrics based on my description and keywords."],
            ['id' => '61','name' => 'Company Bio', 'description' => 'Write a comprehensive company bio based on your inputs', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-building"></i>', 'prompte' => "I need you to write a comprehensive company bio based on my inputs."],
            ['id' => '62','name' => 'App and SMS Notifications', 'description' => 'Notification messages for your apps, websites and mobile devices that grabs users attention', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-mobile-alt"></i>', 'prompte' => "I need you to generate notification messages for my apps, websites, and mobile devices that grab users' attention."],
            ['id' => '63','name' => 'Newsletter Generator', 'description' => 'Generate a newsletter based on the provided information', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-newspaper"></i>', 'prompte' => "I need you to generate a newsletter based on the provided information."],
        ];

        $tools8 = [
            ['id' => '64','name' => 'Blog Titles', 'description' => 'Nobody wants to read boring blog titles, generate catchy blog titles with this tool', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-pencil-alt"></i>', 'prompte' => "Generate catchy blog titles for your articles."],
            ['id' => '65','name' => 'Blog Section', 'description' => 'Write a full blog section (few paragraphs) about a subheading of your article', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-book"></i>', 'prompte' => "Write a full blog section (few paragraphs) about a subheading of your article."],
            ['id' => '66','name' => 'Blog Ideas', 'description' => 'The perfect tool to start writing great articles. Generate creative ideas for your next post', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-lightbulb"></i>', 'prompte' => "Generate creative ideas for your next blog post."],
            ['id' => '67','name' => 'Blog intros', 'description' => 'Write an intro that will entice your visitors to read more about your article', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-comment-alt"></i>', 'prompte' => "Write an intro that will entice your visitors to read more about your article."],
            ['id' => '68','name' => 'Blog Conclusion', 'description' => 'End your blog articles with an engaging conclusion paragraph', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-check-circle"></i>', 'prompte' => "End your blog articles with an engaging conclusion paragraph."],
        ];
        
        foreach ($tools1 as $tool) {
            DB::table('tools')->insert([
                'title' => $tool['name'],
                'description' => $tool['description'],
                'color' => '#ffcece',
                'logo' => $tool['logo'],
                'logo_color' => '#ff5959',
                'Free' => $tool['Free'],
                'Standard' => $tool['Standard'],
                'pro' => $tool['pro'],
                'premium' => $tool['premium'],
                'prompte' => $tool['prompte'],
            ]);
            DB::table('tool_sub_categories')->insert([
                'id_categorie' => 1,
                'id_tool' => $tool['id'],
            ]);
        };
        foreach ($tools2 as $tool) {
            DB::table('tools')->insert([

                'title' => $tool['name'],
                'description' => $tool['description'],
                'color' => '#ffeed9',
                'logo' => $tool['logo'],
                'logo_color' => '#ffba59',
                'Free' => $tool['Free'],
                'Standard' => $tool['Standard'],
                'pro' => $tool['pro'],
                'premium' => $tool['premium'],
                'prompte' => $tool['prompte'],
            ]);
            DB::table('tool_sub_categories')->insert([
                'id_categorie' => 2,
                'id_tool' => $tool['id'],
            ]);
        };
        foreach ($tools3 as $tool) {
            DB::table('tools')->insert([

                'title' => $tool['name'],
                'description' => $tool['description'],
                'color' => '#ffcaf4',
                'logo' => $tool['logo'],
                'logo_color' => '#e016e7',
                'Free' => $tool['Free'],
                'Standard' => $tool['Standard'],
                'pro' => $tool['pro'],
                'premium' => $tool['premium'],
                'prompte' => $tool['prompte'],
            ]);
            DB::table('tool_sub_categories')->insert([
                'id_categorie' => 3,
                'id_tool' => $tool['id'],
            ]);
        };
        foreach ($tools4 as $tool) {
            DB::table('tools')->insert([

                'title' => $tool['name'],
                'description' => $tool['description'],
                'color' => '#e1f7c4',
                'logo' => $tool['logo'],
                'logo_color' => '#a6f515',
                'Free' => $tool['Free'],
                'Standard' => $tool['Standard'],
                'pro' => $tool['pro'],
                'premium' => $tool['premium'],
                'prompte' => $tool['prompte'],
            ]);
            DB::table('tool_sub_categories')->insert([
                'id_categorie' => 4,
                'id_tool' => $tool['id'],
            ]);
        };
        foreach ($tools5 as $tool) {
            DB::table('tools')->insert([

                'title' => $tool['name'],
                'description' => $tool['description'],
                'color' => '#dafcd4',
                'logo' => $tool['logo'],
                'logo_color' => '#15db12',
                'Free' => $tool['Free'],
                'Standard' => $tool['Standard'],
                'pro' => $tool['pro'],
                'premium' => $tool['premium'],
                'prompte' => $tool['prompte'],
            ]);
            DB::table('tool_sub_categories')->insert([
                'id_categorie' => 5,
                'id_tool' => $tool['id'],
            ]);
        };
        foreach ($tools6 as $tool) {
            DB::table('tools')->insert([

                'title' => $tool['name'],
                'description' => $tool['description'],
                'color' => '#d3faf7',
                'logo' => $tool['logo'],
                'logo_color' => '#13e5e9',
                'Free' => $tool['Free'],
                'Standard' => $tool['Standard'],
                'pro' => $tool['pro'],
                'premium' => $tool['premium'],
                'prompte' => $tool['prompte'],
            ]);
            DB::table('tool_sub_categories')->insert([
                'id_categorie' => 6,
                'id_tool' => $tool['id'],
            ]);
        };
        foreach ($tools7 as $tool) {
            DB::table('tools')->insert([

                'title' => $tool['name'],
                'description' => $tool['description'],
                'color' => '#dbe3ff',
                'logo' => $tool['logo'],
                'logo_color' => '#598bff',
                'Free' => $tool['Free'],
                'Standard' => $tool['Standard'],
                'pro' => $tool['pro'],
                'premium' => $tool['premium'],
                'prompte' => $tool['prompte'],
            ]);
            DB::table('tool_sub_categories')->insert([
                'id_categorie' => 7,
                'id_tool' => $tool['id'],
            ]);
        };
        foreach ($tools8 as $tool) {
            DB::table('tools')->insert([
                'title' => $tool['name'],
                'description' => $tool['description'],
                'color' => '#e1dbff',
                'logo' => $tool['logo'],
                'logo_color' => '#8b59ff',
                'Free' => $tool['Free'],
                'Standard' => $tool['Standard'],
                'pro' => $tool['pro'],
                'premium' => $tool['premium'],
                'prompte' => $tool['prompte'],
            ]);
            DB::table('tool_sub_categories')->insert([
                'id_categorie' => 8,
                'id_tool' => $tool['id'],
            ]);
        };

        //image
        $image=[
            ['id' => 69 ,'name' => 'AI Image Generator', 'description' => 'Unleash your creativity with our AI image generator that produces stunning visuals in seconds', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-wand-magic-sparkles"></i>' , 'prompte'=>'generate image '],
        ];
        foreach ($image as $tool) {
            DB::table('tools')->insert([
                'title' => $tool['name'],
                'description' => $tool['description'],
                'color' => '#e1dbff',
                'logo' => $tool['logo'],
                'logo_color' => '#8b59ff',
                'Free' => $tool['Free'],
                'Standard' => $tool['Standard'],
                'pro' => $tool['pro'],
'premium' => $tool['premium'],
                'prompte' => $tool['prompte'],
            ]);
            DB::table('tool_original_categories')->insert([
                'id_categorie' => 2,
                'id_tool' => $tool['id'],
            ]);
        };

        //code
        $code=[
            ['id' => 70 ,'name' => 'AI Code Generator', 'description' => 'Create a various code by using only text commands', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-terminal"></i>' , 'prompte'=>'generate code '],
        ];
        foreach ($code as $tool) {
            DB::table('tools')->insert([
                'title' => $tool['name'],
                'description' => $tool['description'],
                'color' => '#dbe3ff',
                'logo' => $tool['logo'],
                'logo_color' => '#598bff',
                'Free' => $tool['Free'],
                'Standard' => $tool['Standard'],
                'pro' => $tool['pro'],
'premium' => $tool['premium'],
                'prompte' => $tool['prompte'],
            ]);
            DB::table('tool_original_categories')->insert([
                'id_categorie' => 3,
                'id_tool' => $tool['id'],
            ]);
        };
        
        //chat
        $chat=[
            ['id' => 71 ,'name' => 'document Chat', 'description' => 'Analyze the content of your Word/PDF/CSV documents with the help of AI.', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-file-import"></i>' , 'prompte'=>''],
            ['id' => 72 ,'name' => 'Chat Bot', 'description' => 'Find your AI assistant quickly! Get ready to explore our fantastic lineup of AI chat assistants', 'pro' => false, 'premium' => false, 'Free' => false, 'Standard' => true, 'logo' => '<i class="fa-solid fa-comment-dots"></i>' , 'prompte'=>''],
        ];
        foreach ($chat as $tool) {
            DB::table('tools')->insert([

                'title' => $tool['name'],
                'description' => $tool['description'],
                'color' => '#d3faf7',
                'logo' => $tool['logo'],
                'logo_color' => '#13e5e9',
                'Free' => $tool['Free'],
                'Standard' => $tool['Standard'],
                'pro' => $tool['pro'],
'premium' => $tool['premium'],
                'prompte' => $tool['prompte'],
            ]);
            DB::table('tool_original_categories')->insert([
                'id_categorie' => 4,
                'id_tool' => $tool['id'],
            ]);
        };

        //voice
        $voice=[
            ['id' => 73 ,'name' => 'Text To Speech', 'description' => 'Transform the text to speech with any carecter you like', 'pro' => true, 'premium' => false, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-solid fa-file-invoice"></i>' , 'prompte'=>' '],
            ['id' => 74 ,'name' => 'Speech To Text', 'description' => 'Convert voice to text with any language you like', 'pro' => true, 'premium' => false, 'Free' => false, 'Standard' => false, 'logo' => '<i class="fa-solid fa-microphone-lines"></i>' , 'prompte'=>' '],
        ];
        foreach ($voice as $tool) {
            DB::table('tools')->insert([
                'title' => $tool['name'],
                'description' => $tool['description'],
                'color' => '#e1f7c4',
                'logo' => $tool['logo'],
                'logo_color' => '#a6f515',
                'Free' => $tool['Free'],
                'Standard' => $tool['Standard'],
                'pro' => $tool['pro'],
'premium' => $tool['premium'],
                'prompte' => $tool['prompte'],
            ]);
            DB::table('tool_original_categories')->insert([
                'id_categorie' => 5,
                'id_tool' => $tool['id'],
            ]);
        };
        
        // plan
        $plans=[
            ['title'=>'Standard','price'=>'9.99','currency'=>'USD','words'=>'10000','image'=>'100','minute'=>null,'status'=>true,'frequency'=>'month'],
            ['title'=>'Pro','price'=>'19.99','currency'=>'USD','words'=>'50000','image'=>'500','minute'=>'200','status'=>true,'frequency'=>'month'],
            ['title'=>'Premium','price'=>'59.99','currency'=>'USD','words'=>'100000','image'=>'1000','minute'=>'500','status'=>true,'frequency'=>'month'],
        ];
        foreach ($plans as $plan) {
            DB::table('plans')->insert([
                'title' => $plan['title'],
                'price' => $plan['price'],
                'currency' => $plan['currency'],
                'words' => $plan['words'],
                'image' => $plan['image'],
                'minute' => $plan['minute'],
                'status' => $plan['status'],
                'frequency' => $plan['frequency'],
            ]);
        };

        //feilds
        $feilds=[
            ['id_tool'=>'1','title'=>'product title','type'=>'text'],
            ['id_tool'=>'2','title'=>'text to Summarize','type'=>'textarea'],
            ['id_tool'=>'3','title'=>'text to Rewriter','type'=>'textarea'],
            ['id_tool'=>'4','title'=>'title','type'=>'text'],
            ['id_tool'=>'4','title'=>'description','type'=>'textarea'],
            ['id_tool'=>'5','title'=>'title','type'=>'text'],
            ['id_tool'=>'5','title'=>'description','type'=>'textarea'],
            ['id_tool'=>'6','title'=>'text to Summarize','type'=>'textarea'],
            ['id_tool'=>'7','title'=>'product title','type'=>'text'],
            ['id_tool'=>'7','title'=>'product short description','type'=>'textarea'],
            ['id_tool'=>'8','title'=>'startup description','type'=>'textarea'],
            ['id_tool'=>'9','title'=>'product title','type'=>'text'],
            ['id_tool'=>'10','title'=>'essay title','type'=>'text'],
            ['id_tool'=>'10','title'=>'essay description','type'=>'textarea'],
            ['id_tool'=>'11','title'=>'storie title','type'=>'text'],
            ['id_tool'=>'11','title'=>'storie description','type'=>'textarea'],
            ['id_tool'=>'12','title'=>'text to checke grammar','type'=>'textarea'],
            ['id_tool'=>'13','title'=>'text to extend','type'=>''],
            ['id_tool'=>'14','title'=>'the text','type'=>'textarea'],
            ['id_tool'=>'14','title'=>'key words','type'=>'textarea'],
            ['id_tool'=>'15','title'=>'business title','type'=>'text'],
            ['id_tool'=>'15','title'=>'business description','type'=>'textarea'],
            ['id_tool'=>'16','title'=>'text','type'=>'textarea'],
            ['id_tool'=>'17','title'=>'text to extract dictionary word','type'=>'textarea'],
            ['id_tool'=>'18','title'=>'organization title','type'=>'text'],
            ['id_tool'=>'18','title'=>'organization description','type'=>'textarea'],
            ['id_tool'=>'19','title'=>'organization title','type'=>'text'],
            ['id_tool'=>'19','title'=>'organization description','type'=>'textarea'],
            ['id_tool' => '20', 'title' => 'product title', 'type' => 'text'],
            ['id_tool' => '20', 'title' => 'product description', 'type' => 'textarea'],
            ['id_tool' => '21', 'title' => 'product title', 'type' => 'text'],
            ['id_tool' => '21', 'title' => 'product description', 'type' => 'textarea'],
            ['id_tool' => '22', 'title' => 'product benefits', 'type' => 'text'],
            ['id_tool' => '23', 'title' => 'product title', 'type' => 'text'],
            ['id_tool' => '23', 'title' => 'product description', 'type' => 'textarea'],
            ['id_tool' => '24', 'title' => 'product comparison', 'type' => 'textarea'],
            ['id_tool' => '25', 'title' => 'product characteristics', 'type' => 'textarea'],
            ['id_tool' => '26', 'title' => 'email subject', 'type' => 'text'],
            ['id_tool' => '26', 'title' => 'email body', 'type' => 'textarea'],
            ['id_tool' => '27', 'title' => 'email subject', 'type' => 'text'],
            ['id_tool' => '27', 'title' => 'email body', 'type' => 'textarea'],
            ['id_tool' => '28', 'title' => 'email subject', 'type' => 'text'],
            ['id_tool' => '28', 'title' => 'email body', 'type' => 'textarea'],
            ['id_tool' => '29', 'title' => 'email subject', 'type' => 'text'],
            ['id_tool' => '30', 'title' => 'problem', 'type' => 'textarea'],
            ['id_tool' => '30', 'title' => 'agitate', 'type' => 'textarea'],
            ['id_tool' => '30', 'title' => 'solution', 'type' => 'textarea'],
            ['id_tool' => '31', 'title' => 'before', 'type' => 'textarea'],
            ['id_tool' => '31', 'title' => 'after', 'type' => 'textarea'],
            ['id_tool' => '31', 'title' => 'bridge', 'type' => 'textarea'],
            ['id_tool' => '32', 'title' => 'attention', 'type' => 'textarea'],
            ['id_tool' => '32', 'title' => 'interest', 'type' => 'textarea'],
            ['id_tool' => '32', 'title' => 'desire', 'type' => 'textarea'],
            ['id_tool' => '32', 'title' => 'action', 'type' => 'textarea'],
            ['id_tool' => '33', 'title' => 'promise', 'type' => 'textarea'],
            ['id_tool' => '33', 'title' => 'picture', 'type' => 'textarea'],
            ['id_tool' => '33', 'title' => 'proof', 'type' => 'textarea'],
            ['id_tool' => '33', 'title' => 'push', 'type' => 'textarea'],
            ['id_tool' => '34', 'title' => 'brand name', 'type' => 'text'],
            ['id_tool' => '35', 'title' => 'product title', 'type' => 'text'],
            ['id_tool' => '35', 'title' => 'clickbait title', 'type' => 'text'],
            ['id_tool' => '36', 'title' => 'company name', 'type' => 'text'],
            ['id_tool' => '36', 'title' => 'press release content', 'type' => 'textarea'],
            ['id_tool' => '37', 'title' => 'brand/product name', 'type' => 'text'],
            ['id_tool' => '37', 'title' => 'press release content', 'type' => 'textarea'],
            ['id_tool' => '38', 'title' => 'headline', 'type' => 'text'],
            ['id_tool' => '39', 'title' => 'tweet content', 'type' => 'textarea'],
            ['id_tool' => '40', 'title' => 'ad content', 'type' => 'textarea'],
            ['id_tool' => '41', 'title' => 'video description', 'type' => 'textarea'],
            ['id_tool' => '42', 'title' => 'video title', 'type' => 'text'],
            ['id_tool' => '43', 'title' => 'video tags', 'type' => 'text'],
            ['id_tool' => '44', 'title' => 'caption', 'type' => 'textarea'],
            ['id_tool' => '45', 'title' => 'hashtags', 'type' => 'text'],
            ['id_tool' => '46', 'title' => 'post content (personal)', 'type' => 'textarea'],
            ['id_tool' => '47', 'title' => 'post content (business)', 'type' => 'textarea'],
            ['id_tool' => '48', 'title' => 'ad headline', 'type' => 'text'],
            ['id_tool' => '49', 'title' => 'ad headline', 'type' => 'text'],
            ['id_tool' => '50', 'title' => 'ad description', 'type' => 'textarea'],
            ['id_tool' => '51', 'title' => 'video script', 'type' => 'textarea'],
            ['id_tool' => '52', 'title' => 'post content', 'type' => 'textarea'],
            ['id_tool' => '53', 'title' => 'video script', 'type' => 'textarea'],
            ['id_tool' => '54', 'title' => 'ad headline', 'type' => 'text'],
            ['id_tool' => '55', 'title' => 'ad description', 'type' => 'textarea'],
            ['id_tool' => '56', 'title' => 'description', 'type' => 'textarea'],
            ['id_tool' => '57', 'title' => 'product description', 'type' => 'textarea'],
            ['id_tool' => '58', 'title' => 'question', 'type' => 'text'],
            ['id_tool' => '58', 'title' => 'answer', 'type' => 'textarea'],
            ['id_tool' => '59', 'title' => 'testimonial', 'type' => 'textarea'],
            ['id_tool' => '60', 'title' => 'description', 'type' => 'textarea'],
            ['id_tool' => '60', 'title' => 'keywords', 'type' => 'text'],
            ['id_tool' => '61', 'title' => 'company inputs', 'type' => 'textarea'],
            ['id_tool' => '62', 'title' => 'notification message', 'type' => 'textarea'],
            ['id_tool' => '63', 'title' => 'information', 'type' => 'textarea'],
            ['id_tool' => '64', 'title' => 'article', 'type' => 'text'],
            ['id_tool' => '65', 'title' => 'subheading', 'type' => 'text'],
            ['id_tool' => '65', 'title' => 'paragraphs', 'type' => 'textarea'],
            ['id_tool' => '66', 'title' => 'next blog post', 'type' => 'text'],
            ['id_tool' => '67', 'title' => 'article', 'type' => 'textarea'],
            ['id_tool' => '68', 'title' => 'article', 'type' => 'textarea'],
        ];

        foreach ($feilds as $feild) {
            DB::table('tools_feilds')->insert([
                'id_tool' => $feild['id_tool'],
                'title' => $feild['title'],
                'type' => $feild['type'],
            ]);
        };


        ///////////exemples

        //blog
        $blogsExemple = [
            ['id_user'=>'1','title'=>'integrating AI: Enhancing Our Daily Lives','continue'=>'<p>In the rapidly evolving landscape of technology, artificial intelligence (AI) stands at the forefront of innovation, promising to reshape our daily lives in profound ways. From smart assistants that manage our schedules to AI-driven platforms that offer personalized learning experiences, the integration of AI into everyday life is making services more efficient and accessible.</p><p>&nbsp;</p><p>The future of AI in our daily lives is not just about automation or convenience; its about augmenting human capabilities and creating more meaningful interactions. With advancements in natural language processing, AI can now understand and respond to human emotions, offering support in mental health applications. In the realm of smart homes, AI algorithms optimize energy consumption, contributing to a sustainable planet.</p><p>Moreover, personalized healthcare powered by AI is becoming a reality. From early detection of diseases to tailored treatment plans, AI is set to revolutionize how we approach health and wellness. The intersection of AI and IoT (Internet of Things) further enables the monitoring of health parameters in real-time, ensuring a proactive approach to health management.</p><p>&nbsp;</p><p>As we look to the future, the ethical considerations of AI integration become increasingly important. Ensuring privacy, security, and fairness in AI applications is crucial to harness its full potential positively. By addressing these challenges head-on, we can navigate the complexities of AI integration and unlock a future where technology enhances the human experience, making our lives more connected, efficient, and enriched.</p>','image_path'=>'/icon/blog_image/blog1.webp'],
            ['id_user'=>'1','title'=>'Redefining Productivity: AIs Impact on the Workplace','continue'=>'<p>As we venture deeper into the <strong>21st century</strong>, artificial intelligence (AI) is transforming workplaces across the globe, redefining what productivity means in the modern era. The implementation of AI in businesses is not just about automating routine tasks; its about augmenting human intelligence, enabling professionals to focus on creative and strategic activities that drive innovation and growth.</p><p>&nbsp;</p><p>AIs impact on the workplace is multifaceted. In customer service, AI chatbots provide 24/7 support, offering quick responses to queries and improving customer satisfaction. In data analysis, AI algorithms sift through vast amounts of information, identifying patterns and insights that inform decision-making processes. Moreover, AI-driven project management tools are optimizing workflows, ensuring projects are completed efficiently and effectively.</p><p>However, the integration of AI into workplaces also raises important ethical considerations. It necessitates a reevaluation of job roles and a focus on upskilling employees to work alongside AI technologies. Organizations must navigate these changes with a commitment to ethical practices, ensuring AI is used to enhance employee experiences and foster a culture of continuous learning and innovation.</p><p>&nbsp;</p><p>As AI continues to evolve, its potential to transform workplaces is boundless. By embracing AI, businesses can unlock new levels of productivity, creativity, and growth, preparing for a future where human and artificial intelligence collaborate to achieve unprecedented outcomes.</p>','image_path'=>'/icon/blog_image/blog2.webp'],
            ['id_user'=>'1','title'=>'building a Better Future: The Role of Ethical AI in Society','continue'=>'<p><strong>In the age of digital transformation</strong>,</p><p>&nbsp;</p><p>the discussion around artificial intelligence (AI) is increasingly focusing on its ethical implications. Ethical AI is not just a technological challenge; its a societal imperative that demands careful consideration of fairness, privacy, transparency, and accountability. As AI systems become more integral to our lives, ensuring they are developed and deployed in a manner that respects human rights and promotes social good is crucial.</p><p>The role of ethical AI in society extends beyond preventing harm; it involves actively contributing to human well-being and environmental sustainability. From algorithms that reduce bias in hiring processes to AI that monitors and mitigates the impact of climate change, the potential for AI to drive positive change is immense. However, realizing this potential requires a collaborative effort among technologists, policymakers, and the public to establish robust ethical frameworks and governance structures.</p><p>&nbsp;</p><p>Education and awareness are key to fostering an informed dialogue about the ethical use of AI. By demystifying AI and encouraging diverse perspectives in its development, we can create more inclusive and equitable AI systems that reflect the diversity of the societies they serve. Ultimately, ethical AI is about making choices that align with our collective values and aspirations, ensuring technology serves humanitys best interests.</p><p>As we look towards the future, the role of ethical AI in shaping a more just and sustainable world cannot be understated. It offers a blueprint for harnessing technologys power responsibly, paving the way for innovation that respects individual rights and promotes the common good.</p>','image_path'=>'/icon/blog_image/blog3.webp'],
        ];
        foreach ($blogsExemple as $blog) {
            DB::table('blogs')->insert([
                'id_user' => $blog['id_user'],
                'title' => $blog['title'],
                'continue' => $blog['continue'],
                'image_path' => $blog['image_path'],
                'created_at' => '2024-03-31',
            ]);
        };

        //iamage
        $imageExemple = [
            ['id_user'=>'1','id_tool'=>'69','title'=>'black cat','type_data'=>'image','image_path'=>'/icon/image_generated/6602e29a186e19.48586727.webp'],
            ['id_user'=>'1','id_tool'=>'69','title'=>'red dragon','type_data'=>'image','image_path'=>'/icon/image_generated/6602ecf2011775.69221202.webp'],
            ['id_user'=>'1','id_tool'=>'69','title'=>'gray doge','type_data'=>'image','image_path'=>'/icon/image_generated/66040cbf160793.90499138.webp'],
            ['id_user'=>'1','id_tool'=>'69','title'=>'dragon balls','type_data'=>'image','image_path'=>'/icon/image_generated/6604109d1b0668.18489523.webp'],
            ['id_user'=>'1','id_tool'=>'69','title'=>'blue sky','type_data'=>'image','image_path'=>'/icon/image_generated/660407851b0a18.76830569.webp'],
        ];
        foreach ($imageExemple as $image) {
            DB::table('tools_datas')->insert([
                'id_user' => $image['id_user'],
                'id_tool' => $image['id_tool'],
                'title' => $image['title'],
                'type_data' => $image['type_data'],
                'image_path' => $image['image_path'],
                'created_at' => '2024-03-31',
            ]);
        };

        //voice

        $voiceExemple = [
            ['id_user'=>'1','id_tool'=>'74','type_data'=>'voice','voice_path'=>'/icon/voice_generated/660831af1afa75.41575289.mp3','title'=>'660831af1afa75.41575289.mp3','language'=>'English','chars'=>'22','text_content'=>'I see, it seems like there might be an issue with how the class binding is set up. Lets try a different','Gender'=>'','Description'=>'Deep','VoiceName'=>'Adam'],
            ['id_user'=>'1','id_tool'=>'74','type_data'=>'voice','voice_path'=>'/icon/voice_generated/660831cd2b6106.70217746.mp3','title'=>'660831cd2b6106.70217746.mp3','language'=>'English','chars'=>'26','text_content'=>'With these changes, youre first checking if the audio ref exists and has a length greater than 0 before accessing index 0. This should prevent the TypeError you encountered.','Gender'=>'','Description'=>'Childlish','VoiceName'=>'Gigi'],
            ['id_user'=>'1','id_tool'=>'74','type_data'=>'voice','voice_path'=>'/icon/voice_generated/66083204044db8.47536449.mp3','title'=>'66083204044db8.47536449.mp3','language'=>'English','chars'=>'16','text_content'=>'You can achieve this by keeping track of whether the audio is currently playing or not.','Gender'=>'','Description'=>'Anxious','VoiceName'=>'Harry'],
            ['id_user'=>'1','id_tool'=>'74','type_data'=>'voice','voice_path'=>'/icon/voice_generated/660832f3563191.04488369.mp3','title'=>'660832f3563191.04488369.mp3','language'=>'Arabic','chars'=>'15','text_content'=>'يمكنك تحقيق ذلك من خلال تتبع ما إذا كان الصوت قيد التشغيل حاليًا أم لا.','Gender'=>'','Description'=>'Strong','VoiceName'=>'Bill'],
        ];
        foreach ($voiceExemple as $voice) {
            DB::table('tools_datas')->insert([
                'id_user' => $voice['id_user'],
                'id_tool' => $voice['id_tool'],
                'type_data' => $voice['type_data'],
                'voice_path' => $voice['voice_path'],
                'title' => $voice['title'],
                'language' => $voice['language'],
                'chars' => $voice['chars'],
                'text_content' => $voice['text_content'],
                'Gender' => $voice['Gender'],
                'Description' => $voice['Description'],
                'VoiceName' => $voice['VoiceName'],
                'created_at' => '2024-03-31',
            ]);
        };

        //code

        $codeExemple = [
            ['id_user'=>'1','id_tool'=>'70','title'=>'java','language'=>'java','text_content'=>'write hello word 10 times','htmlContent'=>'<div><p>Sure, here is the code in Java that will write "Hello World" 10 times:

            </p></div><div><pre>                                    <div class="header">
                                                    <div class="title"></div>
                                                    <div class="button"><i class="fa-solid fa-copy"></i></div>
                                                </div>
                                                <code class="hljs ebnf"><span class="hljs-attribute">java
            public class HelloWorld</span> {
            <span class="hljs-attribute">    public static void main</span>(String[] args) {
            <span class="hljs-attribute">        for</span> (int i = 0; i &lt; 10; i++) {
            <span class="hljs-attribute">            System</span>.out.println("Hello World");
                    }
                }
            }
            </code>
                                            </pre></div><!--v-if-->'],
            ['id_user'=>'1','id_tool'=>'70','title'=>'laravel','language'=>'laravel','text_content'=>'sened request from vue js to laravel','htmlContent'=>'<div><p>in order to send a request from Vue.js to Laravel, you can use axios, a popular HTTP client for JavaScript. Heres an example code snippet for sending a POST request from Vue.js to a Laravel backend:

                </p></div><div><pre>                                    <div class="header">
                                                        <div class="title"></div>
                                                        <div class="button"><i class="fa-solid fa-copy"></i></div>
                                                    </div>
                                                    <code class="hljs ebnf"><span class="hljs-attribute">javascript</span>
                // Vue component method where the axios POST request is made
                <span class="hljs-attribute">methods</span>: {
                <span class="hljs-attribute">  sendData</span>() {
                <span class="hljs-attribute">    axios</span>.post(http://your-laravel-api-url/api/sendData, {
                <span class="hljs-attribute">      data</span>: Hello from Vue.js
                    })
                    .then(response =&gt; {
                      console.log(response.data);
                    })
                    .catch(error =&gt; {
                      console.error(error);
                    });
                  }
                }
                </code>
                                                </pre></div><div><p>
                
                in your Laravel routes/api.php file, you can define a route to handle this request:
                
                </p></div><div><pre>                                    <div class="header">
                                                        <div class="title"></div>
                                                        <div class="button"><i class="fa-solid fa-copy"></i></div>
                                                    </div>
                                                    <code class="hljs css">php
                // Laravel route <span class="hljs-selector-tag">to</span> handle the incoming POST request
                Route::<span class="hljs-built_in">post</span>(<span class="hljs-string">/sendData</span>, <span class="hljs-string">ApiController@sendData</span>);
                </code>
                                                </pre></div><div><p>
                
                And in your Laravel controller, you can handle the request and send a response:
                
                </p></div><div><pre>                                    <div class="header">
                                                        <div class="title"></div>
                                                        <div class="button"><i class="fa-solid fa-copy"></i></div>
                                                    </div>
                                                    <code class="hljs css">php
                // Laravel controller method <span class="hljs-selector-tag">to</span> handle the incoming POST request
                public function sendData(Request $request) {
                  $data = $request-&gt;<span class="hljs-selector-tag">input</span>(data);
                  
                  // Do something with the data 
                  
                  return response()-&gt;json(<span class="hljs-selector-attr">[<span class="hljs-string">message</span> =&gt; <span class="hljs-string">Data received successfully</span>]</span>);
                }
                </code>
                                                </pre></div><div><p>
                
                Make sure to adjust the URLs and routes to match your Laravel setup, and dont forget to include axios in your Vue.js project. Let me know if you need further assistance with this code snippet or have any other questions!</p></div><!--v-if-->'],
        ];
        foreach ($codeExemple as $code) {
            DB::table('tools_datas')->insert([
                'id_user' => $code['id_user'],
                'id_tool' => $code['id_tool'],
                'type_data' => 'code',
                'title' => $code['title'],
                'language' => $code['language'],
                'text_content' => $code['text_content'],
                'htmlContent' => $code['htmlContent'],
                'created_at' => '2024-03-31',
            ]);
        };


    }
}
