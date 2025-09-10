import { useState } from 'react';
import { Icon, Tab } from '../components';
import FreePro from './FreePro';
import Homepage from "./Home";
import Offers from './Offers';
import UsefulPlugins from './UsefulPlugins';
import FAQ from './FAQ';
import StarterSites from './StarterSites';
import { __ } from '@wordpress/i18n';

function Dashboard() {
    const [activeTabTitle, setActiveTabTitle] = useState('Home');

        const tabsData = [
            {
                title: __( 'Home', 'benevolent' ),
                icon: <Icon icon="home" />,
                content: <Homepage />
            },
            {
                title: __( 'Starter Sites', 'benevolent' ),
                icon: <Icon icon="globe" />,
                content: <StarterSites />
            },
            {
                title: __( 'Free vs Pro', 'benevolent' ),
                icon: <Icon icon="freePro" />,
                content: <FreePro />
            },
            {
                title: __( 'Offers', 'benevolent' ),
                icon: <Icon icon="offers" />,
                content: <Offers />
            },
            {
                title: __( 'FAQs', 'benevolent' ),
                icon: <Icon icon="support" />,
                content: <FAQ />
            },
            {
                title: __( 'Useful Plugins', 'benevolent' ),
                icon: <Icon icon="plugins" />,
                content: <UsefulPlugins />
            }
        ];

    const handleTabChange = (title) => {
        setActiveTabTitle(title);
    };

    return (
        <>
            <Tab
                tabsData={tabsData}
                onChange={handleTabChange}
                activeTabTitle={activeTabTitle}
            />
        </>
    );
}

export default Dashboard;
