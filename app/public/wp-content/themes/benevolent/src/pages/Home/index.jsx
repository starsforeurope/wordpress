import { Icon, Sidebar, Card, Heading } from "../../components";
import { __ } from '@wordpress/i18n';

const Homepage = () => {
    const cardLists = [
        {
            iconSvg: <Icon icon="site" />,
            heading: __('Site Identity', 'benevolent'),
            buttonText: __('Customize', 'benevolent'),
            buttonUrl: cw_dashboard.custom_logo
        },
        {
            iconSvg: <Icon icon="frontpagesetting" />,
            heading: __('Home Page Settings', 'benevolent'),
            buttonText: __('Customize', 'benevolent'),
            buttonUrl: cw_dashboard.front
        },
        {
            iconSvg: <Icon icon="colorsetting" />,
            heading: __("Color Settings", 'benevolent'),
            buttonText: __('Customize', 'benevolent'),
            buttonUrl: cw_dashboard.colors
        },
        {
            iconSvg: <Icon icon="generalsetting" />,
            heading: __("Default Settings"),
            buttonText: __('Customize', 'benevolent'),
            buttonUrl: cw_dashboard.general
        },
        {
            iconSvg: <Icon icon="footersetting" />,
            heading: __('Footer Settings', 'benevolent'),
            buttonText: __('Customize', 'benevolent'),
            buttonUrl: cw_dashboard.footer
        }
    ];

    const proSettings = [
        {
            heading: __('Header Layouts', 'benevolent'),
            para: __('Choose from different unique header layouts.', 'benevolent'),
            buttonText: __('Learn More', 'benevolent'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Layouts', 'benevolent'),
            para: __('Choose layouts for blogs, banners, posts and more.', 'benevolent'),
            buttonText: __('Learn More', 'benevolent'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            heading: __('Multiple Sidebar', 'benevolent'),
            para: __('Set different sidebars for posts and pages.', 'benevolent'),
            buttonText: "Learn More",
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Boost your website performance with ease.', 'benevolent'),
            heading: __('Performance Settings', 'benevolent'),
            buttonText: __('Learn More', 'benevolent'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Choose typography for different heading tags.', 'benevolent'),
            heading: __('Typography Settings', 'benevolent'),
            buttonText: __('Learn More', 'benevolent'),
            buttonUrl: cw_dashboard?.get_pro
        },
        {
            para: __('Import the demo content to kickstart your site.', 'benevolent'),
            heading: __('One Click Demo Import', 'benevolent'),
            buttonText: __('Learn More', 'benevolent'),
            buttonUrl: cw_dashboard?.get_pro
        }
    ];

    const sidebarSettings = [
        {
            heading: __('We Value Your Feedback!', 'benevolent'),
            icon: "star",
            para: __("Your review helps us improve and assists others in making informed choices. Share your thoughts today!", 'benevolent'),
            imageurl: <Icon icon="review" />,
            buttonText: __('Leave a Review', 'benevolent'),
            buttonUrl: cw_dashboard.review
        },
        {
            heading: __('Knowledge Base', 'benevolent'),
            para: __("Need help using our theme? Visit our well-organized Knowledge Base!", 'benevolent'),
            imageurl: <Icon icon="documentation" />,
            buttonText: __('Explore', 'benevolent'),
            buttonUrl: cw_dashboard.docmentation
        },
        {
            heading: __('Need Assistance? ', 'benevolent'),
            para: __("If you need help or have any questions, don't hesitate to contact our support team. We're here to assist you!", 'benevolent'),
            imageurl: <Icon icon="supportTwo" />,
            buttonText: __('Submit a Ticket', 'benevolent'),
            buttonUrl: cw_dashboard.support
        }
    ];

    return (
        <>
            <div className="customizer-settings">
                <div className="cw-customizer">
                    <Heading
                        heading={__( 'Quick Customizer Settings', 'benevolent' )}
                        buttonText={__( 'Go To Customizer', 'benevolent' )}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={cardLists}
                        cardPlace='customizer'
                        cardCol='three-col'
                    />
                    <Heading
                        heading={__( 'More features with Pro version', 'benevolent' )}
                        buttonText={__( 'Go To Customizer', 'benevolent' )}
                        buttonUrl={cw_dashboard?.customizer_url}
                        openInNewTab={true}
                    />
                    <Card
                        cardList={proSettings}
                        cardPlace='cw-pro'
                        cardCol='two-col'
                    />
                    <div className="cw-button">
                        <a href={cw_dashboard?.get_pro} target="_blank" className="cw-button-btn primary-btn long-button">{__('Learn more about the Pro version', 'benevolent')}</a>
                    </div>
                </div>
                <Sidebar sidebarSettings={sidebarSettings} openInNewTab={true} />
            </div>
        </>
    );
}

export default Homepage;