var cleaveDate = new Cleave("#cleave-date", {
        date: !0,
        delimiter: "-",
        datePattern: ["d", "m", "Y"],
    }),
    cleaveDateFormat = new Cleave("#cleave-date-format", {
        date: !0,
        datePattern: ["m", "y"],
    }),
    cleaveTime = new Cleave("#cleave-time", {
        time: !0,
        timePattern: ["h", "m", "s"],
    }),
    cleaveTimeFormat = new Cleave("#cleave-time-format", {
        time: !0,
        timePattern: ["h", "m"],
    }),
    cleaveNumeral = new Cleave("#cleave-numeral", {
        numeral: !0,
        numeralThousandsGroupStyle: "thousand",
    }),
    cleaveBlocks = new Cleave("#cleave-ccard", {
        blocks: [4, 4, 4, 4],
        uppercase: !0,
    }),
    cleaveDelimiter = new Cleave("#cleave-delimiter", {
        delimiter: "·",
        blocks: [3, 3, 3],
        uppercase: !0,
    }),
    cleaveDelimiters = new Cleave("#cleave-delimiters", {
        delimiters: [".", ".", "-"],
        blocks: [3, 3, 3, 2],
        uppercase: !0,
    }),
    cleavePrefix = new Cleave("#cleave-prefix", {
        prefix: "PREFIX",
        delimiter: "-",
        blocks: [6, 4, 4, 4],
        uppercase: !0,
    }),
    cleaveBlocks = new Cleave("#cleave-phone", {
        delimiters: ["(", ")", "-"],
        blocks: [0, 3, 3, 4],
    });
