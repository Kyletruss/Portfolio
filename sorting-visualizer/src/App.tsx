
import { useState } from "react";
import { Grid, GridItem, Show, Box } from "@chakra-ui/react";
import NavBar from "./MyComponents/NavBar";
import { useColorMode, useColorModeValue } from "./components/ui/color-mode"
import * as Chakra from "@chakra-ui/react";
import AlgorithmList from "./MyComponents/AlgorithmList";

function App() {
 

  const { toggleColorMode } = useColorMode()

  const bg = useColorModeValue("rgb(244, 244, 245)", "rgb(24, 24, 27)")
 const color = useColorModeValue("gray.800", "white")

 const algorithms = [
  {name: "Algorithm 1", id: 1},
  {name: "Algorithm 2", id: 2},
  {name: "Algorithm 3", id: 3},
  {name: "Algorithm 4", id: 4}
 ];



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
        <AlgorithmList algorithms={algorithms} />
      </GridItem>

        <GridItem area='main'>Main</GridItem>
      </Grid>
    </Box>

  )

}



export default App;