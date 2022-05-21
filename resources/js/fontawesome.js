import { config, library, dom } from '@fortawesome/fontawesome-svg-core';
config.autoReplaceSvg = 'nest';

import {faCaretUp,
    faCaretDown,
    faStar,
    faPlus,
    faCheck,
    faComment,
    faMessage,
    faQuestion,
    faMagnifyingGlass,
    faHome,
    faEnvelope,
    faPhone,
    faPrint,
    faCircleQuestion
    } from '@fortawesome/free-solid-svg-icons';

library.add(faCaretUp,
    faCaretDown,
    faStar,
    faPlus,
    faCheck,
    faComment,
    faMessage,
    faQuestion,
    faMagnifyingGlass,
    faHome,
    faEnvelope,
    faPhone,
    faPrint,
    faCircleQuestion);

dom.watch()
