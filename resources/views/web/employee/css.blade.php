@push('styles')
    <style>
        :root {
            --level-1: #64b2de;
            --level-2: #64b2de;
            --level-3: #64b2de;
            --level-4: #64b2de;
            --black: black;
            --white: white;
        }

        .container {
            width: 100%;
            color: var(--white);
            justify-content: center;
            text-align: center;
        }

        ol {
            list-style: none;
        }

        .rectangle {
            position: relative;
            padding: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            border-radius: 5px;
        }


        /* LEVEL-1 STYLES
                    –––––––––––––––––––––––––––––––––––––––––––––––––– */
        .level-1 {
            width: 20%;
            margin: 0 auto 40px;
            background: var(--level-1);
        }

        .level-1::before {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 20px;
            background: var(--black);
        }


        /* LEVEL-2 STYLES
                    –––––––––––––––––––––––––––––––––––––––––––––––––– */
        .level-2-wrapper {
            position: relative;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
        }

        .level-2-wrapper::before {
            content: "";
            position: absolute;
            top: -20px;
            left: 25%;
            width: 50%;
            height: 2px;
            background: var(--black);
        }

        .level-2-wrapper::after {
            display: none;
            content: "";
            position: absolute;
            left: -20px;
            bottom: -20px;
            width: calc(100% + 20px);
            height: 2px;
            background: var(--black);
        }

        .level-2-wrapper li {
            position: relative;
        }

        .level-2-wrapper>li::before {
            content: "";
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 20px;
            background: var(--black);
        }

        .level-2 {
            width: 35%;
            margin: 0 auto 40px;
            background: var(--level-2);
        }

        .level-2::before {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 20px;
            background: var(--black);
        }

        .level-2::after {
            display: none;
            content: "";
            position: absolute;
            top: 50%;
            left: 0%;
            transform: translate(-100%, -50%);
            width: 20px;
            height: 2px;
            background: var(--black);
        }


        /* LEVEL-3 STYLES
                    –––––––––––––––––––––––––––––––––––––––––––––––––– */
        .level-3-wrapper {
            position: relative;
            display: grid;
            grid-template-columns: repeat(var(--n), 1fr);
            grid-column-gap: 17px;
            margin: 0 9px;
        }

        .level-3-wrapper::before {
            content: "";
            position: absolute;
            top: -20px;
            left: 35px;
            /* adjustment = 5px */
            width: calc(100% - 70px);
            /* adjustment width */
            height: 2px;
            background: var(--black);
        }

        .level-3-wrapper>li {
            width: 70px;

        }

        .level-3-wrapper>li::before {
            content: "";
            position: absolute;
            top: 0;
            left: 50%;
            transform: translate(-50%, -100%);
            width: 2px;
            height: 20px;
            background: var(--black);
        }

        .level-3 {
            margin-bottom: 20px;
            background: var(--level-3);

            height: 120px;
        }


        /* LEVEL-4 STYLES
                    –––––––––––––––––––––––––––––––––––––––––––––––––– */
        .level-4-wrapper {
            position: relative;
            width: 80%;
            margin-left: auto;
        }

        .level-4-wrapper::before {
            content: "";
            position: absolute;
            top: -20px;
            left: -20px;
            width: 2px;
            height: calc(100% + 20px);
            background: var(--black);
        }

        .level-4-wrapper li+li {
            margin-top: 20px;
        }

        .level-4 {
            font-weight: normal;
            background: var(--level-4);
        }

        .level-4::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 0%;
            transform: translate(-100%, -50%);
            width: 20px;
            height: 2px;
            background: var(--black);
        }


        /* MQ STYLES
                    –––––––––––––––––––––––––––––––––––––––––––––––––– */
        @media screen and (max-width: 900px) {
            .rectangle {
                padding: 20px 10px;
            }

            .level-1,
            .level-2 {
                width: 100%;
            }

            .level-1 {
                margin-bottom: 20px;
            }

            .level-1::before,
            .level-2-wrapper>li::before {
                display: none;
            }

            .level-2-wrapper,
            .level-2-wrapper::after,
            .level-2::after {
                display: block;
            }

            .level-2-wrapper.hidden::after {
                display: none;
            }

            .level-2-wrapper {
                width: 90%;
                margin-left: 10%;
            }

            .level-2-wrapper::before {
                left: -20px;
                width: 2px;
                height: 100%;
            }

            .level-2-wrapper>li:not(:first-child) {
                margin-top: 50px;
            }
        }
    </style>
@endpush
