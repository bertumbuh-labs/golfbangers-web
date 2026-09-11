(function () {
  const DEFAULT_COURSES = {
    valley: {
      label: "Lembah",
      holes: [
        { no: 1, local: 1, par: 5, index: 15 },
        { no: 2, local: 2, par: 3, index: 17 },
        { no: 3, local: 3, par: 4, index: 5 },
        { no: 4, local: 4, par: 4, index: 3 },
        { no: 5, local: 5, par: 4, index: 1 },
        { no: 6, local: 6, par: 4, index: 13 },
        { no: 7, local: 7, par: 4, index: 11 },
        { no: 8, local: 8, par: 3, index: 9 },
        { no: 9, local: 9, par: 5, index: 7 }
      ]
    },
    lake: {
      label: "Danau / Lake",
      holes: [
        { no: 10, local: 1, par: 4, index: 10 },
        { no: 11, local: 2, par: 4, index: 18 },
        { no: 12, local: 3, par: 3, index: 16 },
        { no: 13, local: 4, par: 5, index: 6 },
        { no: 14, local: 5, par: 4, index: 14 },
        { no: 15, local: 6, par: 4, index: 4 },
        { no: 16, local: 7, par: 4, index: 2 },
        { no: 17, local: 8, par: 3, index: 12 },
        { no: 18, local: 9, par: 5, index: 8 }
      ]
    },
    hill: {
      label: "Bukit",
      holes: [
        { no: 19, local: 1, par: 4, index: 1 },
        { no: 20, local: 2, par: 4, index: 17 },
        { no: 21, local: 3, par: 3, index: 7 },
        { no: 22, local: 4, par: 4, index: 15 },
        { no: 23, local: 5, par: 4, index: 3 },
        { no: 24, local: 6, par: 5, index: 11 },
        { no: 25, local: 7, par: 3, index: 5 },
        { no: 26, local: 8, par: 4, index: 9 },
        { no: 27, local: 9, par: 5, index: 13 }
      ]
    }
  };

  function createAcakHoleModule(options = {}) {
    const courses = options.courses || DEFAULT_COURSES;

    function selectedHoles(courseKeys) {
      return courseKeys.flatMap(key => {
        const course = courses[key];
        if (!course) return [];
        return course.holes.map(hole => ({ ...hole, course: course.label }));
      });
    }

    function shuffle(holes) {
      const out = holes.slice();
      for (let i = out.length - 1; i > 0; i -= 1) {
        const j = Math.floor(Math.random() * (i + 1));
        [out[i], out[j]] = [out[j], out[i]];
      }
      return out;
    }

    function acak(courseKeys, limit) {
      const holes = selectedHoles(courseKeys);
      return holes.slice(0, Math.min(limit, holes.length)).map((hole, index) => ({
        ...hole,
        order: index + 1,
        tee: randomTee(hole)
      }));
    }

    function formatUrutan(holes) {
      return holes.map(hole => {
        const parLabel = hole.par === 3 ? " (Par 3)" : "";
        return `Hole ${hole.no}${parLabel}: ${hole.tee}`;
      }).join("\n");
    }

    function teeOptions(hole) {
      return hole.par === 5 ? ["Hitam", "Biru"] : ["Hitam", "Biru", "Putih"];
    }

    function randomTee(hole) {
      const options = teeOptions(hole);
      return options[Math.floor(Math.random() * options.length)];
    }

    function whatsappText(holes) {
      return `Tee Box Hari Ini:\n${formatUrutan(holes)}`;
    }

    return {
      acak,
      courses,
      formatUrutan,
      teeOptions,
      whatsappText
    };
  }

  window.createAcakHoleModule = createAcakHoleModule;
})();
