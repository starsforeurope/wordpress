import { __ } from "@wordpress/i18n";
import { Card } from "../../components";
import { mainDemo, demo2, demo3, demo4, demo5, demo6, demo7 } from "../../components/images"

const StarterSites = () => {
    const starterCardSettings = [
        {
            heading: __('Benevolent Pro', 'benevolent'),
            imageurl: mainDemo,
            buttonUrl: "https://rarathemesdemo.com/benevolent-pro/"
        },
        {
            heading: __('Benevolent Pro​ 2', 'benevolent'),
            imageurl: demo2,
            buttonUrl: "https://rarathemesdemo.com/benevolent-pro-2/"
        },
        {
            heading: __('Benevolent Pro​ 3', 'benevolent'),
            imageurl: demo3,
            buttonUrl: "https://rarathemesdemo.com/benevolent-pro-3/"
        },
        {
            heading: __('Benevolent Pro​ 4', 'benevolent'),
            imageurl: demo4,
            buttonUrl: "https://rarathemesdemo.com/benevolent-pro-4/"
        },
        {
            heading: __('Benevolent Pro​ 5', 'benevolent'),
            imageurl: demo5,
            buttonUrl: "https://rarathemesdemo.com/benevolent-pro-5/"
        },
        {
            heading: __('Benevolent Pro​ 6', 'benevolent'),
            imageurl: demo6,
            buttonUrl: "https://rarathemesdemo.com/benevolent-pro-6/"
        },
        {
            heading: __('Benevolent Pro​ 7', 'benevolent'),
            imageurl: demo7,
            buttonUrl: "https://rarathemesdemo.com/benevolent-pro-7/"
        },
    ];

    return (
        <>
            <Card
                cardList={starterCardSettings}
                cardPlace='starter'
                cardCol='three-col'
            />
        </>
    )
}

export default StarterSites;