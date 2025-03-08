
import { useState } from "react";
import { Grid, GridItem, Show, Box } from "@chakra-ui/react";
import NavBar from "./MyComponents/NavBar";
import { useColorMode, useColorModeValue } from "./components/ui/color-mode"
import * as Chakra from "@chakra-ui/react";
import AlgorithmList from "./MyComponents/AlgorithmList";
import SortingPanel from "./MyComponents/SortingPanel";

function App() {

  const algorithms = [
    {name: "Bubble Sort", id: 1},
    {name: "Selection Sort", id: 2},
    {name: "Quick Sort", id: 3},
    {name: "Merge Sort", id: 4}
   ];

  const [selectedAlgorithmId, setSelectAlgorithm] = useState<number | null>(null);


  const selectedAlgorithm = algorithms.find(
    (algorithm) => algorithm.id === selectedAlgorithmId
  );

  const { toggleColorMode } = useColorMode()

  const bg = useColorModeValue("rgb(244, 244, 245)", "rgb(24, 24, 27)")
  const color = useColorModeValue("gray.800", "white")
  const cSecondary = useColorModeValue("#e5e5e5", "#252525")





  return(
    <Box bgColor={bg} bgSize="cover" h='calc(100vh)'>
      <Grid templateAreas={{
        base: `"nav" "main"`,
        lg: `"nav nav" "aside main"`

      }} 
      templateColumns={{
        base: '1fr',
        lg: '200px 1fr'
      }}
      bg={bg} color={color}>
        <GridItem area='nav'>
          <NavBar onChangeTheme={toggleColorMode}></NavBar>
        </GridItem>

        <GridItem area="aside" display={{ base: "none", lg: "block" }}>
        <AlgorithmList algorithms={algorithms} onSelectAlgorithm={setSelectAlgorithm}/>
      </GridItem>

        <GridItem area='main'><Box h="80vh" bgColor={cSecondary} mr="10" ml="10" borderRadius="lg" ><SortingPanel selectedAlgorithm={selectedAlgorithm}></SortingPanel></Box></GridItem>
      </Grid>
    </Box>

  )

}



export default App;