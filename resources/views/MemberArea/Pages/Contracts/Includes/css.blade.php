<style>
    #chartdiv {
        width: 100%;
        height: 300px;
    }

    /* .soax-input {
        font-size: 1.5rem;
        font-weight: 700;
        text-align: center;
        color: #24242e;
        background-color: #ececec;
        border-radius: 4px;
        border: 1px solid 24242e;
    } */

    /* input[type=number]:focus {
        border: 2px solid 24242e;
        border-radius: 4px;
        color: #24242e;
        background-color: #ececec;
    } */


    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0;
        /* <-- Apparently some margin are still there even though it's hidden */
    }

</style>
