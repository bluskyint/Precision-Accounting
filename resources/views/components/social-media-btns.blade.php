<div id="share-btns-container">
    <span>Share</span>
    {!!
        Share::currentPage()
        ->facebook()
        ->twitter()
        ->linkedin()
        ->whatsapp()
        ->telegram()
        ->reddit()
	!!}
</div>

<style>
    #share-btns-container {
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        font-weight: bold;
        margin-top: 20px;
    }

    #social-links {

    }

    #social-links ul {
        list-style: none;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 16px;
        margin-bottom: 0;
    }

    #social-links ul li {

    }

    #social-links ul li a {
        font-size: 30px;
    }
</style>
